<?php
/**
 * Contiene metodos utiles, utilizados por toda la aplicación.
 *
 * @author Frank
 */
namespace Otros\NomencladorBundle\Services;


class Util
{
    private $em, $validator;
            
    function __construct($doctrine, $validator)
    {
        $this->em = $doctrine->getManager();
        $this->validator = $validator;
    }

    /**
     * A partir de un objeto devolver un arreglo con su contenido.
     * 
     * @param entity $entity Entidad a la que se le va aplicar el método.
     * 
     * @return array
     */
    public function toArray($entity)
    {
        $array = array();
        
        foreach ($entity as $obj) {
            $array[] = $obj->toArray();
        }
        return $array;
    }
    
    /**
     * Eliminar entidades a partir de un arreglo de IDs.
     * 
     * @param array         $ids Identificadores usados para obtener entidades a partir de estos.
     * @param entity        $namespace Namespace de la Entidad a la que se le va aplicar el método.
     * 
     * @return type
     */
    public function remove($ids, $namespace)
    {
        foreach (json_decode($ids) as $id)
        {
            $en = $this->em->getRepository($namespace)->find($id);
            $this->em->remove($en);
        }
        return $this->em->flush();
    }
    
    /**
     * Devolver un boolean a partir de un string.
     * 
     * @param string $string
     * 
     * @return boolean
     */
    public function boolean($string)
    {
        switch ($string)
        {
//            case 'F':
//                return false;
            case 'SI':
                return \TRUE;
            default:
                return \FALSE;
        }
    }
  
    /**
     * Obtener entidad a partir de su nombre o identificador.
     * 
     * @param string         $namespace Namespace de la Entidad a la que se le va aplicar el método.
     * @param string         $campo Llave del arreglo a la que se le va asignar un valor.
     * @param string/integer $valor Valor que será asignado como criterio.
     * 
     * @return Entity Entidad resultante..
     */
    public function entity($namespace, $campo, $valor)
    {
        switch (is_numeric($valor))
        {
            case true:
                return $this->em->getRepository($namespace)->find($valor);
            default:
                return $this->em->getRepository($namespace)->findOneBy(array($campo => $valor));
        }        
    }
    
    /**
     * Valida la entidad y de ser correcta la inserta en base de datos.
     * 
     * @param Entity  $entity Entidad a validar.
     * 
     * @return string
     */
    public function validate($entity)
    {
        if (count($this->validator->validate($entity)) > 0)
        {
            return 'Unico';
        }
        else
        {
            $this->em->persist($entity);
            return $this->em->flush();
        }
    }
    
    /**
     * Valida la entidad y de ser correcta la retorna.
     * 
     * @param Entity  $entity Entidad a validar.
     * 
     * @return object/string
     */
    public function isValid($entity)
    {
        if (count($this->validator->validate($entity)) > 0)
        {
            return \FALSE;
        }
        else
        {
            return \TRUE;
        }
    }

    /**
     * Get day, year, month or all (day month an year).
     *
     * @param $date Date.
     * @param $part Part of day.
     *
     * @return string
     */
    public function str_date ($date, $part)
    {
        setlocale(LC_ALL, "es_CU.UTF-8");

        list($year, $month, $day) = explode('-', $date);

        $mktime = mktime(0, 0, 0, $month, $day, $year);

        switch($part)
        {
            case 'Y':
                $str_date = ucwords(strftime("%Y", $mktime));
                break;
            case 'm':
                $str_date = ucwords(strftime("%B", $mktime));
                break;
            case 'd':
                $str_date = ucwords(strftime("%d", $mktime));
                break;
            default:
                $str_date = strftime("%d de %B de %Y", $mktime);
        }
        return $str_date;
    }
}
