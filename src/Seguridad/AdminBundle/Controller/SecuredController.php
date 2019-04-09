<?php

namespace Seguridad\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class SecuredController extends Controller
{
    /**
     * @Route("login", name="login")
     * @Template()
     */
    public function loginAction()
    {
        return array('entorno' => $this->get("router")->getContext()->getBaseUrl());
    }

    /**
     * @Route("login/check", name="security_check")
     */
    public function securityCheckAction(Request $rq)
    {
        $user_provider = $this->get('admin.user');
        $security_auth = $this->get('admin.security');

        $user = $user_provider->loadUserByUsername($rq->get('username'), $rq->get('rolename'));

        if (!is_string($user)) //-Verificar que es un objeto de tipo Users.
        {
            if ($user->getIsActive())//-Si el usuario esta activo.
            {   // Buscar usuario en servidor ldap y compruebo password..
                $ldap_search = $user_provider->loadUserFromLdap($rq->get('username'), $rq->get('password'));
                // TRUE on success or FALSE on failure.
                if($ldap_search === \TRUE)
                {
                    $response = $security_auth->authenticatedUserByLdap($user, $rq->get('password'), $rq->get('rolename'));

                    return new Response($response);
                }
                elseif ($ldap_search === \FALSE)
                {
                    $response = $security_auth->authenticatedUserByDataBase($user, $rq->get('password'), $rq->get('rolename'));

                    return new Response($response);
                }
                // No existe una entrada para ese usuario o sus credenciales son Invalidas.
                return new Response($ldap_search);
            }
            else
            {
                return new Response('0');
            }
        }
        return new Response($user);
    }

    /**
     * @Route("logout", name="logout")
     */
    public function logoutAction()
    {
    }
}
