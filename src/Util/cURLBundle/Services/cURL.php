<?php

namespace Util\cURLBundle\Services;

use Util\cURLBundle\Resources\File;

use Exception;

class cURL
{
    private $file;
    
    private $cookie;
    
    function __construct(File $file)
    {
        $this->file = $file;
        $this->cookie = $file->cookie();
    }

    public function init($string)
    {   // $string = nombre del fichero principal y usuario para el Login.
        $this->file->init($string);
        
        $this->login();
        
        return $this;
    }
    
    private function login()
    {
        $data = $this->file->data();
        // Crear un recurso curl..
        $ch = curl_init();
        // Configurar el objeto curl.
        curl_setopt($ch, CURLOPT_URL, $data['URL']);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->dataString($data['Data']));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        // Ejecutar.
        @curl_exec($ch);
        // Comprobar si occurió algún error.
        if(curl_errno($ch))
        {
           throw new Exception('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        // Cerrar recurso.
        curl_close($ch);
    }    
    
    public function listing($action, $data_array)
    {   // Cargar información del fichero.
        $this->file->load($action);
        // Obtener URL.
        $url = $this->file->url();
        // Completar url.
        if($data_array['Query'] !== '')
        {
            $url .= $this->queryString($data_array['Query']);
        }
        // Crear un recurso curl..
        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Ejecutar.
        $output = @curl_exec($ch);
        // Comprobar si occurió algún error.
        if(curl_errno($ch))
        {
           throw new Exception('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        // Cerrar recurso.
        curl_close($ch);
        // Retornar recurso.
        return $output;
    }    
    
    public function action($action, $data_array)
    {
        // Cargar información del fichero.
        $this->file->load($action);
        // Menu.
        switch ($this->file->method())
        {
            case 'POST':
                $this->POST($this->file->url(), $data_array) ;
                break;
        }
    }
    
    private function POST($url, $data_array)
    {   // Completar url.
        if($data_array['Query'])
        {
            $url .= $this->queryString($data_array['Query']);
        }
        // Crear un recurso curl..
        $ch = curl_init();
        // Configurar el objeto curl.
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->dataString($data_array['Data']));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        
        @curl_exec($ch);
        
        if (curl_errno($ch) === 0)
        {
          curl_close($ch);
          
          return true;
        }
        throw new Exception('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
    }    
    
    private function dataString($data)
    {
        $data_string = '';
        
        foreach($data as $key => $value)
        {
            $data_string .= trim($key) .'='. trim($value) .'&';
        }
        return rtrim($data_string, '&');
    }
    
    private function queryString($query) 
    {
        $query_string = '';
        
        foreach($query as $key => $value)
        {
            $query_string .= trim($key) .'='. urlencode(trim($value)) .'&';
        }
        return '?'. rtrim($query_string, '&');
    }
}
