<?php
namespace Seguridad\AdminBundle\Security;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Router;

/*
 * Metodos utlizados por el Bundle, en distintos momentos. Esta clase es un servicio 
 */
class Util
{
    private $router, $session;
    
    public function __construct(Router $router, Session $session)
    {
        $this->router = $router;
        $this->session = $session;
    }
    
    /**
     * Redireccionar al modulo especifico y escribir el fichero 'js/cdtij/portal/ext-4.2.1/shared/data_login.js',
     * 
     * @param string $rolename Nombre del rol del usuario logueado..
     */
    public function redirect($rolename)
    {
        //return '/app.php/'. $rolename;
        return $this->router->getContext()->getBaseUrl() .'/'. $rolename;
    }

    /**
     * Obtener un array PHP a partir de un fichero Yaml.
     * 
     * @param string $path Ruta hasta el fichero pero no se incluye el nombre del fichero.
     * @param string $filename Nombre del fichero seguido de la extención Yamel.
     */    
    public function parse($path, $filename)
    {
        $util = new \Util\cURLBundle\Services\Util;
        
        return $util->parse($path, $filename);
    }
    
    /**
     * Convertir en texto plano textos encriptados de forma reversible.
     * 
     * @param type $encriptado_text
     * @return string
     */
    public function getPlainText($encriptado_text)
    {
        $encriptado = pack('H*',str_replace(' ', '', $encriptado_text));

        return trim(mcrypt_decrypt('rijndael-128','12345678911234567892123456789312', $encriptado, 'cbc', '1234567891123456'));
    }
    
    /**
     * Codifica el password para poder compararlo con el almacenado en Data Bases.
     * 
     * @param type $password
     * @return string
     */
    public function getEncodePassword($password)
    {
        $pbkdf2 = new \Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder();
        
        return $pbkdf2->encodePassword($this->getPlainText($password), false);
    }
    
    /**
     * Retorna el entorno en el que se encuentra la aplicación. (app.php, app_dev.php)
     * 
     * @return string
     */
    public function getEntorno()
    {
         return $this->router->getContext()->getBaseUrl();
    }
}