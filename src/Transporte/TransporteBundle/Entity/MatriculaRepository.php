<?php

namespace Transporte\TransporteBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MatriculaRepository extends EntityRepository
{
    /**
     * Listar todas las matriculas de la Unidad Organizativa actual.
     * 
     * @param type $uo_id ID de la Unidad Organizativa del usuario logeado en el sistema.
     * 
     * @return Object
     */
    public function findMatriculas($uo_id)
    {
        $query = $this
                ->getEntityManager()
                ->createQuery('SELECT m FROM TransporteBundle:Matricula m '.
                        'JOIN m.vehiculo v JOIN v.area a JOIN a.unidadOrganizativa uo WHERE uo.id = :id');
        $query->setParameter('id', $uo_id);
        
        return $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
    }
    
    /**
     * Encontrar si existen campos unicos.
     *
     * @param type $id Id.
     * @param type $chapa Chapa.
     * @param type $vieja Chapa vieja.
     * @param type $circulacion Circulación.
     *
     * @return boolean.
     */
    public function findUnicos($id, $chapa, $vieja, $circulacion)
    {
        $where = ' WHERE m.id <> '.$id.' AND (';
        
        foreach (array('m.chapa' => $chapa, 'm.chapaVieja' => $vieja, 'm.circulacion' => $circulacion) as $key => $value)
        {
            if ($value != '')
            {
                $where .= $key.' = \''.$value.'\' OR ';
            }
        }
        $query = $this->getEntityManager()->createQuery('SELECT COUNT(m) FROM TransporteBundle:Matricula m'. rtrim($where, ' OR ').')');
        $resul = $query->getSingleScalarResult();
        
        return ($resul == 0) ? \TRUE : \FALSE;
    }
}