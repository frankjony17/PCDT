<?php
/**
 * Contiene metodos utiles, usados en toda la aaplicación.
 *
 * @author Frank
 */
namespace Util\cURLBundle\Services;

use Exception;
use Symfony\Component\Yaml\Yaml;

class Util
{
    /**
     * Obtener un array PHP a partir de un fichero Yaml.
     * 
     * @param string $path Ruta hasta el fichero pero no se incluye el nombre del fichero.
     * @param string $filename Nombre del fichero seguido de la extención Yamel.
     */
    public function parse($path, $filename)
    {
        $realpath = realpath(__DIR__.'/../../../'.$path);

        if($realpath !== NULL)
        {
            if(is_file($realpath .'/'. $filename))
            {
                $array = Yaml::parse(file_get_contents($realpath .'/'. $filename));
                
                return $array;
            }
            else 
            {
                throw new Exception("El fichero ". $realpath .'/'. $filename . " no existe.");
            }
        }
        else
        {
            throw new Exception("El directorio ". $realpath . " no existe.");
        }
    }    
}
