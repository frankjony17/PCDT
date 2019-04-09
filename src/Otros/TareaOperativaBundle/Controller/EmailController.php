<?php

namespace Otros\TareaOperativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("email/")
 */
class EmailController extends Controller
{
    /**
     * @Route("responsables/send")
     */
    public function responsablesAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $from = $user->getEmail();
        $email = $this->get("cdt.email");
        $tarea_op = $em->getRepository("TareaOperativaBundle:TareaOperativa")->find($rq->get("TareaId"));

        foreach ($tarea_op->getTareaOperativaTrabajador() as $trabajador)
        {
            $user = $em->getRepository("AdminBundle:Users")->findOneBy(array("trabajador_id" => $trabajador->getTrabajador()->getId()));

            $email->subject("Puntualización de la Tarea Operativa : ". $tarea_op->getNumeroTarea());
            $email->from($from);

            $email->send($user->getEmail(), "<ins><b>". $rq->get("TareaName") ."</b></ins> :<br>". $rq->get("Contenido"));
        }
        return new Response('');
    }

    /**
     * @Route("otros/send")
     */
    public function otrosAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $from = $user->getEmail();
        $email = $this->get("cdt.email");

        foreach (json_decode($rq->get("Destinatarios")) as $id)
        {
            $user = $em->getRepository("AdminBundle:Users")->findOneBy(array("trabajador_id" => $id));

            $email->subject("Puntualización de la Tarea Operativa : ". $rq->get("TareaName"));
            $email->from($from);

            $email->send($user->getEmail(), "<ins><b>". $rq->get("TareaName") ."</b></ins> :<br>". $rq->get("Contenido"));
        }
        return new Response('');
    }
}