<?php

namespace Seguridad\AdminBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Seguridad\AdminBundle\Security\Util;

class SecurityAuthentication
{
    private $em, $util, $session, $userProvider;
            
    function __construct(Util $util, $session, $doctrine, UserProvider $userProvider)
    {
        $this->util = $util;
        $this->session = $session;
        $this->em = $doctrine->getManager();
        $this->userProvider = $userProvider;
    }
    
    /**
     * Autenticar usuario contra LDAP.
     * 
     * @param entity $user Entidad Seguridad\AdminBundle\Entity\User
     * @param string $password Contraseña.
     * @param string $rolename Nombre del rol.
     * 
     * @return redirect function.
     */
    public function authenticatedUserByLdap($user, $password, $rolename)
    {
        if ($user->getPassword() !== $this->util->getEncodePassword($password))
        {
            $user->setPassword($password);
            $this->em->persist($user);
            $this->em->flush();
        }
        return $this->setAuthenticate($user, $password, $rolename);
    }
    
    /**
     * Autenticar usuario contra base de datos.
     * 
     * @param entity $user Entidad Seguridad\AdminBundle\Entity\User
     * @param string $password Contraseña.
     * @param string $rolename Nombre del rol.
     * 
     * @return redirect function.
     */
    public function authenticatedUserByDataBase($user, $password, $rolename)
    {
        if ($user->getPassword() === $this->util->getEncodePassword($password))
        {
            return $this->setAuthenticate($user, $password, $rolename);
        }
        return '2';
    }

    /**
     * Autenticar usuario y aplicar roles.
     *
     * @param entity $user Entidad Seguridad\AdminBundle\Entity\User
     * @param string $password Contraseña.
     * @param $rolename
     * @return string
     */
    private function setAuthenticate($user, $password, $rolename)
    {
        try
        {
            $token = new UsernamePasswordToken(
                $user,
                $password,
                '_security_cdt',
                $user->getRoles()
            );
            
            $this->session->set('_security_cdt', serialize($token));
            $this->session->set('roles', $user->getRoles());
            $this->session->set('user', $user->getUsername());
            
            $user_data = $this->userProvider->loadDataByUsername($user->getUsername());
            
            if ($user_data !== false)
            {
                $this->session->set('trabajador_id', $user_data["trabajador_id"]);
                $this->session->set('departamento_id', $user_data["departamento_id"]);
                $this->session->set('area_id', $user_data["area_id"]);
                $this->session->set('unidad_organizativa_id', $user_data["unidad_organizativa_id"]);
                $this->session->set('nombre_apellidos_trabajador', $user_data["nombre_apellidos"]);
                $this->session->set('nombre_departamento', $user_data["departamento"]);
                $this->session->set('nombre_area', $user_data["area"]);
                $this->session->set('nombre_unidad_organizativa', $user_data["unidad_organizativa"]);
                $this->session->set('entorno', $this->util->getEntorno());
            }
            $this->session->start();
            //-----Actualizar-entrada-de-sesion---------------------------------
            $user->setDateLastLogin(new \DateTime(date('Y-m-d')));
            $user->setTimeLastLogin(new \DateTime(date('H:i:s')));
            $this->em->persist($user);
            $this->em->flush();        
            //------------------------------------------------------------------
            return $this->util->redirect($rolename, $user_data);
        }
        catch (Exception $exc)
        {
            echo $exc->getTraceAsString();
        }
    }
}
