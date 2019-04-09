<?php
/**
 * This file is part of the ETECSA package.
 *
 * @author Frank Ricardo <frank.ricardo@etecsa.cu>
 */
namespace Util\cURLBundle\Services;

use Monolog\Logger as BaseLogger,
    Monolog\Handler\StreamHandler,
    Symfony\Component\Filesystem\Filesystem,
    Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class Logger
{
    private $logger, $path, $file, $filesystem;
            
    function __construct()
    {
        $this->path = __DIR__.'/../../../../app/logs/';
        $this->filesystem = new Filesystem();
    }
    
    /**
     * Inicializar Logger class
     * 
     * @param string $name Nombre del Logger.
     */
    public function init($name='CDT')
    {
        switch ($name)
        {
            case 'CDT':
                $this->file = 'prod.log';
                break;
            default:
                $this->file = strtolower($name).'.log';
                break;
        }
        $this->logger = new BaseLogger($name);
        
        $this->logger->pushHandler(new StreamHandler($this->path.''.$this->file));
        
        return $this;
    }

    /**
     * Añadir información en un fichero de log determinado.
     * 
     * @param string $message Mensaje del log.
     * @param string $levels Nivel del mensaje.
     * 
     * @return \Util\cURLBundle\Services\Logger
     */
    public function add($message, $levels='INFO')
    {
        switch ($levels)
        {
            case 'INFO':
                $this->logger->addInfo($message);
                break;
            case 'WARNING':
                $this->logger->addWarning($message);
                break;
            case 'ERROR':
                $this->logger->addError($message);
                break;            
            default:
                break;
        }
        return $this;
    }

    /**
     * Limpiar la información de los logs.
     * 
     * @return \Util\cURLBundle\Services\Logger
     */
    public function clear($log='')
    {
        try
        {
            $path = realpath($this->path);
            $file = $path.'/'.$log.'.log';
            
            if (is_file($file))
            {
                $this->filesystem->dumpFile($file, '', 0644);
            }
            else
            {
                $filenames = scandir($path, 1);
                
                foreach ($filenames as $name)
                {
                    $array = explode('.', $name);
                    
                    if ($array[0] !== '')
                    {
                        $this->filesystem->dumpFile($path.'/'.$array[0].'.log', '', 0644);
                    }
                }
            }
            return $this;
        }
        catch (IOExceptionInterface $e)
        {
            $this->addMessageAllLog('No se pudieron BORRAR los logs: '.$e->getPath(), 'ERROR');
        }
    }
    
    /**
     * Añadir información a todos los ficheros logs existentes en: /app/logs.
     * 
     * @param string $message Mensaje del log.
     * @param string $levels Nivel del mensaje.
     */
    public function addMessageAllLog($message, $levels)
    {
        $path = realpath($this->path);
        
        $filenames = scandir($path, 1);
                
        foreach ($filenames as $name)
        {
            $array = explode('.', $name);
                    
            if ($array[0] !== '')
            {
                $name = strtoupper($array[0]);
                
                $this->init($name);
                $this->add($message, $levels);
            }
        }
        return $this;
    }
}
