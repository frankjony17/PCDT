<?php

namespace Util\cURLBundle\Resources;

use Exception;
use Symfony\Component\Yaml\Yaml;

class File
{
    private $dir;
    
    private $path;

    private $client;
    
    public function init($string)
    {
        $array = $this->explode('-', $string, 2);
        
        if (is_dir(__DIR__ .'/config/' . $array[0]))
        {
            $this->dir = __DIR__ . '/config/' . $array[0];
            
            $this->client = $array[1];
        }
        else
        {
            throw new Exception('Ruta inválida: '. __DIR__.'/config/'.$array[0]);
        }
    }
    
    public function data()
    {
        $temp = array();
        
        $data = Yaml::parse($this->dir.'/login.yml');
        
        foreach ($data[$this->client] as $key => $value)
        {
            $temp[$key] = $value;
        }
        
        return array(
            'URL'  => trim($data['URL']),
            'Data' => $temp
        );
    }
    
    public function load($action)
    {
        $array = $this->explode('-', $action, 2);
        
        $this->path = $this->dir.'/'.$array[0].'.yml';
        $this->action = $array[1];
    }
    
    public function url()
    {
        $data = Yaml::parse($this->path);
        
        return $data[$this->action]['URL'];
    }
    
    public function method()
    {
        $data = Yaml::parse($this->path);
        
        return $data[$this->action]['Method'];
    }
    
    public function cookie()
    {
        return __DIR__.'/config/cookie/cookie.curl';
    }
    
    private function explode($ch, $string, $val)
    {
        $array = explode($ch, $string);
        
        return $this->validate($array, $val);
    }
    
    private function validate($array, $val)
    {
        if (count($array) === $val)
        {
            return $array;
        }
        throw new Exception('El parámetro: "$string" pasado a la función File->init($string), es inválido. [function:validate]');
    }
    
}
