<?php

namespace Util\cURLBundle\Controller;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request;

use Util\cURLBundle\Entity\EmailAddress,
    Util\cURLBundle\Entity\EmailModulo;

/**
 * @Route("email/")
 */
class EmailController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction()
    {
        $data = $this->getDoctrine()->getManager()->getRepository('cURLBundle:EmailAddress')->findUsers($this->get('session')->get('unidad_organizativa_id'));

        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("add")
     */
    public function addAction(Request $rq)
    {
        $modulo = new EmailModulo();
        $modulo->setModulo($rq->get("Modulo"));
        $modulo->setDescripcion($rq->get("Descripcion"));

        $em = $this->getDoctrine()->getManager();

        if (count($this->get("validator")->validate($modulo)) > 0)
        {
            return new Response('UnicoModulo');
        } else {
            $em->persist($modulo);
        }
        $address = new EmailAddress();
        $address->setAddress($rq->get("Address"));
        $address->setEmailModulo($modulo);
        $address->setUnidadOrganizativa($this->getDoctrine()->getManager()->find('NomencladorBundle:UnidadOrganizativa', $this->get('session')->get('unidad_organizativa_id')));

        return new Response($this->get('otros.util')->validate($address));
    }

    /**
     * @Route("remove")
     */
    public function removeAction(Request $rq)
    {
        foreach (json_decode($rq->get("ids")) as $ids)
        {
            $this->
            getDoctrine()->
            getManager()->
            getConnection()->
            fetchAll("DELETE FROM email_users WHERE email_users.users_id = ".$ids[0]." AND email_users.email_address_id = ".$ids[1].";");
        }
        return new Response("");
    }

    /**
     * @Route("add_user")
     */
    public function addUserAction(Request $rq)
    {
        $i = 0; $v = true;
        $em = $this->getDoctrine()->getManager();
        $address = $em->getRepository("cURLBundle:EmailAddress")->findOneBy(array(
            "address" => $rq->get("Address")
        ));
        $users = $address->getUsers();
        foreach (json_decode($rq->get('Users')) as $id)
        {
            $user = $em->find("AdminBundle:Users", $id);
            foreach($users as $us){if($us===$user){$v=false;}}
            if ($v) {
                if ($user->getEmail()){
                    $address->addUser($user);
                    $em->persist($address);
                } else {
                    $i++;
                }
            }
            $v = true;
        }
        $em->flush();
        return new Response($i);
    }

    /**
     * @Route("recordatorio")
     */
    public function recordatorioTareasOperativasAction(Request $rq)
    {   // Login...
        $logger = $this->get("cdt.logger")->init("tareasoperativas_email");
        $user_provider = $this->get('admin.user');
        $user = $user_provider->loadUserByUsername($rq->get('username'), "tareasoperativas");
        // Si user is object...
        if (is_string($user))
        {
            $logger->add('23 Usuario no es un Objeto.', "ERROR");
            return new Response("tareasoperativas_email.log ===> ERROR");
        }
        // Encoder password...
        $pbkdf2 = new \Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder();
        $password = $pbkdf2->encodePassword($rq->get('password'), \FALSE);
        // Si password coincide...
        if ($password === $user->getPassword())
        {   // Autenticación...
            $token = new UsernamePasswordToken($user, $password, '_security_cdt', $user->getRoles());
            $this->get("session")->set('_security_cdt', serialize($token));
            // Email...
            $em = $this->getDoctrine()->getManager();
            $email = $this->get("cdt.email");
            $user_data = $user_provider->loadDataByUsername($user->getUsername());
            $tarea_operativa = $em->getRepository('TareaOperativaBundle:TareaOperativa')->findTareasEmail($user_data["unidad_organizativa_id"]);
            // Recordatorio a los responsables...
            $entity_email = $em->getRepository("cURLBundle:EmailAddress")->findOneBy(
                array(
                    "emailModulo" => $em->getRepository("cURLBundle:EmailModulo")->findOneBy(array("modulo" => "tareasoperativas")),
                    "unidadOrganizativa" => $user_data["unidad_organizativa_id"]
            ));
            //-
            if (count($entity_email) > 0)
            {
                foreach ($tarea_operativa as $key => $value)
                {
                    $email->subject("Recordatorio: Tareas Operativas Pendientes!!!");
                    $email->from($entity_email->getAddress());
                    $user = $em->getRepository("AdminBundle:Users")->findOneBy(array("trabajador_id" => $key));
                    $email->send($user->getEmail(), $this->renderView("TareaOperativaBundle:Email:emailRecordatorio.html.twig", array("tareas" => $value)));
                }
                // Recordatorio a Tecnicos, Especialistas, Jefe CDT y Director...
                if (count($tarea_operativa) > 0)
                {
                    foreach ($entity_email->getUsers() as $usr)
                    {
                        $email->subject("Recordatorio: Tareas Operativas Pendientes!!!");
                        $email->from($entity_email->getAddress());
                        $email->send($usr->getEmail(), $this->renderView( "TareaOperativaBundle:Email:emailResumen.html.twig", array("tareas" => $tarea_operativa)));
                    }
                }
                else
                {
                    $logger->add('65 Cero Tareas Operativas.', "ERROR");
                    return new Response("tareasoperativas_email.log ===> ERROR");
                }
                $logger->add('67 Email OK.', "INFO");
                return new Response("tareasoperativas_email.log ===> INFO");
            }
            $logger->add('69 No hay quien envie el email.', "ERROR");
            return new Response("tareasoperativas_email.log ===> ERROR");
        }
        $logger->add('71 PASSWORD incorrecto.', "WARNING");
        return new Response("tareasoperativas_email.log ===> WARNING");
    }
}