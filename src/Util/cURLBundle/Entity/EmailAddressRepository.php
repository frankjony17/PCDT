<?php

namespace Util\cURLBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EmailAddressRepository extends EntityRepository
{

    public function findUsers($uo_id=\NULL)
    {
        $email = array();

        $query = $this->getEntityManager()->createQuery('SELECT ea FROM cURLBundle:EmailAddress ea JOIN ea.unidadOrganizativa uo WHERE uo.id = :id');
        $query->setParameter('id', $uo_id);
        $emailAddress = $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);

        foreach ($emailAddress as $ea)
        {
            if (count($users = $ea->getUsers()) > 0)
            {
                foreach ($users as $user)
                {
                    $trabajador = $this->getEntityManager()->getRepository('NomencladorBundle:Trabajador')->find(
                        $user->getTrabajadorId()
                    );
                    $email[] = array(
                        'user_id' => $user->getId(),
                        'email' => $user->getEmail(),
                        'trabajador' => $trabajador->getNombreApellidos(),
                        'modulo' => $ea->getEmailModulo()->getModulo()." <=> Email: ".$ea->getAddress()." <=> Descripción: (".$ea->getEmailModulo()->getDescripcion().")",
                        'modulo_id' => $ea->getEmailModulo()->getId(),
                        'address_id' => $ea->getId()
                    );
                }
            } else {
                $email[] = array(
                    'user_id' => "",
                    'email' => "No se han asignado usuarios.",
                    'trabajador' => "...",
                    'modulo' => $ea->getEmailModulo()->getModulo()." <=> Email: ".$ea->getAddress()." <=> Descripción: (".$ea->getEmailModulo()->getDescripcion().")",
                    'modulo_id' => $ea->getEmailModulo()->getId(),
                    'address_id' => $ea->getId()
                );
            }
        }
        return $email;
    }
}