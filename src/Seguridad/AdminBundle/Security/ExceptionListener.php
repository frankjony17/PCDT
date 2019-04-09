<?php
namespace Seguridad\AdminBundle\Security;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

use Seguridad\AdminBundle\Security\Util;

class ExceptionListener
{
    private $router, $util;
    
    public function __construct(Util $util, Router $router)
    {
        $this->util = $util;
        $this->router = $router;
    }
    
    public function onKernelException(GetResponseForExceptionEvent $event)
    {   // You get the exception object from the received event.
        $exception = $event->getException();
        // Si la excepción es de tipo Acceso denegado.
        if($exception->getMessage() === "Access Denied")
        {   // Deslogueo al usuario.
            $event->setResponse(new RedirectResponse($this->router->generate('logout')));
        }
    }
}
