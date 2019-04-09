<?php
namespace Transporte\TransporteBundle\Services;

/*
 * Metodos utlizados por el Bundle, en distintos momentos. Esta clase es un servicio 
 */
class Util
{
    public function getModulo($ambito, $roles)
    {
        foreach ($roles as $rol)
        {
            $string_array = explode("_", $rol);
            
            if (count($string_array) >= 3 && $ambito == $string_array[2])
            {
                return \strtolower($string_array[1]);
            }
        }
        return "NO-ROLE-FOR-".$ambito;
    }
}