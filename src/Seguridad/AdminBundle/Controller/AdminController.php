<?php

namespace Seguridad\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Seguridad\AdminBundle\Entity\Roles;
use Seguridad\AdminBundle\Entity\Users;

class AdminController extends Controller
{
    /**
     * @Route("/", name="admin")
     * @Template()
     */
    public function indexAction()
    {
        return array('session' => $this->get('session'));
    }
    
    /**
     * @Route("roles/list")
     */
    public function listRoleAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $roles = $this->get('otros.util')->toArray($em->getRepository('AdminBundle:Roles')->findAll());
        
        if (count($roles) === 0)
        {   
            $yaml_roles = $this->get('cdt.util')->parse('Seguridad/AdminBundle/Resources/config', 'roles.yml');

            foreach ($yaml_roles as $key => $array_values)
            {
                foreach ($array_values as $value)
                {
                    $role = new Roles();
                    $role->setName($key);
                    $role->setRole($value);
                    
                    $em->persist($role);
                }
            }            
            $em->flush();
            $em->close();
            
            $roles = $this->get('otros.util')->toArray($em->getRepository('AdminBundle:Roles')->findAll());
        }
        return new Response('({"total":"'.count($roles).'","data":'.json_encode($roles).'})');
    }
    
    /**
     * @Route("roles/list_roles_users")
     */
    public function listRoleUsersAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        
        $roles = $em->getRepository('AdminBundle:Roles')->findAll();
        $users = $em->getRepository('AdminBundle:Users')->find($rq->get("Id"));
        
        $users_roles = array();
        
        foreach ($roles as $rol) 
        {
            $estado = \FALSE;
            
            if(in_array($rol->getRole(), $users->getRoles()))
            {
                $estado = \TRUE;
            }
            $users_roles[] = array(
                'id'     => $rol->getId(),
                'name'   => strtoupper($rol->getName()),
                'role'   => $rol->getRole(),
                'estado' => $estado
            );
        }
        return new Response('({"total":"'.count($users_roles).'","data":'.json_encode($users_roles).'})');
    }
    
    /**
     * @Route("users/list")
     */
    public function listUsersAction()
    {
        $users = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Users')->findUsers($this->get('session')->get('unidad_organizativa_id'));
        
        return new Response('({"total":"'.count($users).'","data":'.json_encode($users).'})');
    }

    /**
     * @Route("users/list_user_db")
     */
    public function listUsersDBAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        
        $users = $em->getRepository('AdminBundle:Users')->findUsersFromDataBase($rq->get('Area'), $rq->get('limit'), $rq->get('start'), $this->get('session')->get('unidad_organizativa_id'));

        $count = $em->getRepository('AdminBundle:Users')->findCantidadTrabajadores($this->get('session')->get('unidad_organizativa_id'));
        
        return new Response('({"total":"'.$count.'","data":'.json_encode($users).'})');
    }
    
//    /**
//     * @Route("users/list_user_ldap")
//     */
//    public function listUsersLDAPAction()
//    {
//        $users = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Users')->findUsersFromLDAP($this->get('cdt.util'));
//        
////        $count = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Users')->findCantidadTrabajadores();
//        
//        return new Response('({"total":"'.count($users).'","data":'.json_encode($users).'})');
//    }
    
    /**
     * @Route("users/load_new_users")
     */
    public function loadNewUsersAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();

        foreach (json_decode($rq->get('Users')) as $user)
        {
            if ($user[0] === 'LDAP')
            {
                $trabajador = $em->getRepository('NomencladorBundle:Trabajador')->findOneBy(array('nombreApellidos'=>$user[1]));

                if (count($trabajador) > 0)
                {
                    $users = new Users();
                    $users->setUsername($user[2]);
                    $users->setPassword(12345678);
                    $users->setEmail($user[3]);
                    $users->setTrabajadorId($trabajador->getId());
                    $users->setIsActive(\FALSE);
                }
            } else {
                $users = new Users();
                $users->setUsername($user[2]);
                $users->setPassword('1234567');
                $users->setTrabajadorId($user[0]);
                $users->setIsActive(\FALSE);
            }
            $em->persist($users);
        }
        return new Response($em->flush());
    }
    
    /**
     * @Route("users/remove_users")
     */
    public function removeUsersAction(Request $rq)
    {
        if ($rq->getMethod() == 'POST')
        {   // Borrar entidades a partir de un identificador...
            return new Response($this->get('otros.util')->remove($rq->get("ids"), 'AdminBundle:Users'));
        } 
        throw $this->createNotFoundException('Esta acción no esta permitida.');             
    }
    
    /**
     * @Route("users/active_users")
     */
    public function activeUsersAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $us = $em->getRepository('AdminBundle:Users')->find($rq->get("Id"));

        if ($us->getIsActive())
        {
            $us->setIsActive(\FALSE);
        } else {
            $us->setIsActive(\TRUE);
        }
        $em->persist($us);

        return new Response($em->flush());
    }
    
    /**
     * @Route("users/edit_users")
     */
    public function editUsersAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $us = $em->getRepository('AdminBundle:Users')->find($rq->get("Id"));

        $us->setUsername($rq->get("Alias"));
        $us->setEmail($rq->get("Correo"));

        $val = $em->getRepository('AdminBundle:Users')->countUsers($rq->get("Id"), $rq->get("Alias"), $rq->get("Correo"));

        if (count($val) > 0)
        {
            return new Response('Unico');
        }

        return new Response($em->flush($us));
    }
    
    /**
     * @Route("users/add_roles_users")
     */
    public function addRolesUsersAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $us = $em->getRepository('AdminBundle:Users')->find($rq->get("Id"));

        foreach (json_decode($rq->get('Roles')) as $val)
        {
            $rol = $em->getRepository('AdminBundle:Roles')->find($val->id);

            if ($val->estado == true)
            {
                if (!in_array($rol->getRole(), $us->getRoles()))
                {
                    $us->addRole($rol);
                }
            }
            else
            {
                if (in_array($rol->getRole(), $us->getRoles()))
                {
                    $us->removeRole($rol);
                }
            }
        }
        return new Response($em->flush());
    }
}