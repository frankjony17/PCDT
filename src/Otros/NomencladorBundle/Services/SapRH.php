<?php
/**
 * This file is part of the ETECSA package.
 *
 * @author Frank Ricardo <frank.ricardo@etecsa.cu>
 */
namespace Otros\NomencladorBundle\Services;

use Util\cURLBundle\Services\Util,
    Util\cURLBundle\Services\Logger,
    Otros\NomencladorBundle\Entity\Departamento,
    Otros\NomencladorBundle\Entity\Trabajador;

class SapRH
{
    private $em, $util, $logger;
    
    private $file;
    
    private $codeDepartamento, $enitysDepartamento;
            
    function __construct(Util $util, Logger $logger, $doctrine)
    {
        $this->em = $doctrine->getManager();
        $this->util = $util;
        $this->logger = $logger->init('SAP');
        //-
        $this->file = $this->openFile();
        //-
        $this->codeDepartamento = array();
        $this->enitysDepartamento = array();
        
    }

    /**
     * Actualizar Base de Datos a partir de fichero SAP.
     * 
     * @param array $uo Claves que representan Unidades organizativas.
     * 
     * @return string
     */
    public function updateDatabase($keys)
    {
        if (is_resource($this->file))
        {
            $estructura = $this->getEstructuras();
            // Leer fichero SAP.
            while ($line = fgets($this->file))
            {
                if (strlen($line) > 100)
                {   // Get first 48 character in one array.
                    $line_array = str_split($line, 48);
                    // Get first 8 element from $line_array = code.
                    $departamen_code = utf8_encode(substr($line_array[0], 0, 8));
                    // Identificar si el departamento debe de ser procesado.
                    if ($this->isCorrectDepartment($keys, $departamen_code, $estructura))
                    {
                        $departamen_name = utf8_encode(substr($line_array[0], 8, 40));
                        $trabajador_code = utf8_encode(substr($line_array[1], 0, 8));
                        $trabajador_name = utf8_encode(substr($line_array[1], 8, 40));
                        // Select departametos.
                        if (!array_key_exists($departamen_code, $this->enitysDepartamento))
                        {
                            $this->enitysDepartamento[$departamen_code] = $this->em->getRepository('NomencladorBundle:Departamento')->findOneBy(array('codigo' => $departamen_code));
                        }
                        // Procesar departamento
                        if (!in_array($departamen_code, $this->codeDepartamento))
                        {
                            if ($this->enitysDepartamento[$departamen_code])
                            {
                                if ($this->enitysDepartamento[$departamen_code]->getNombre() != $departamen_name)
                                {
                                    $this->persistDepartamento($this->enitysDepartamento[$departamen_code], $departamen_code, $departamen_name);
                                }
                            }
                            else
                            {
                                $this->enitysDepartamento[$departamen_code] = new Departamento();
                                $this->persistDepartamento($this->enitysDepartamento[$departamen_code], $departamen_code, $departamen_name);
                            }
                            $this->codeDepartamento[] = $departamen_code;
                        }
                        // Procesar Trabajadores.
                        $trabajador = $this->em->getRepository('NomencladorBundle:Trabajador')->findOneBy(array('numeroPlaza' => $trabajador_code));
                        // Si existe.
                        if ($trabajador)
                        {
                            if ($trabajador->getNombreApellidos() != $trabajador_name || $trabajador->getDepartamento() != $this->enitysDepartamento[$departamen_code])
                            {
                                $this->persistTrabajador($trabajador, $trabajador_code, $trabajador_name, $this->enitysDepartamento[$departamen_code]);
                            }
                        }
                        else
                        {
                            $this->persistTrabajador(new Trabajador(), $trabajador_code, $trabajador_name, $this->enitysDepartamento[$departamen_code]);
                        }
                    }
                }
            }
            // Salvar en Base de Datos.
            $this->em->flush();
            // Closes an open file pointer
            fclose($this->file);
            // Añadir información en Logs de SAP
            $this->logger->add('Base de datos actualizada correctamente a partir del fichero SAP.', 'INFO');
            // Respuesta.
            return 'Base de datos actualizada correctamente a partir del fichero SAP';
        }
        return 'No se puede abrir el fichero [ SapRH > openFile() ]';
    }
    
    /**
     * Añadir o actualizar un Trabajador.
     * 
     * @param Entity $trabajador_entity
     * @param string $trabajador_code
     * @param string $trabajador_name
     * @param Entity $departamento
     */
    private function persistTrabajador($trabajador_entity, $trabajador_code, $trabajador_name, $departamento)
    {
        $trabajador_entity->setNumeroPlaza($trabajador_code);
        $trabajador_entity->setNombreApellidos($trabajador_name);
        $trabajador_entity->setDepartamento($departamento);
        $this->em->persist($trabajador_entity);
    }
    
    /**
     * Añadir o actualizar un Departamento.
     * 
     * @param Entity $departamento_entity
     * @param string $departamen_code
     * @param string $departamen_name
     */
    private function persistDepartamento($departamento_entity, $departamen_code, $departamen_name)
    {
        $departamento_entity->setCodigo($departamen_code);
        $departamento_entity->setNombre($departamen_name);
        $this->em->persist($departamento_entity);
    }
    
    /**
     * Obtener el fichero AlimentacionSAP.txt del FTP
     * 
     * @return recurso
     */
    private function openFile()
    {
        try
        {
            $yaml_sap = $this->util->parse('Otros/NomencladorBundle/Resources/config', 'sap_rh.yml');
            // Obtener fichero.
            @$file_sap = fopen('ftp://'. $yaml_sap['user'] .':'. $yaml_sap['pass'] .'@'. $yaml_sap['host'] .'/'. $yaml_sap['file'], 'r');
            // Si existe.
            if ($file_sap)
            {
                return $file_sap;
            }
            else
            {
                $this->logger->add('No se puede abrir el fichero [ SapRH > openFile() ]', 'ERROR');
                return \FALSE;
            }
        }
        catch (Exception $exc)
        {
            return $this->logger->add($exc->getTraceAsString(), 'ERROR');
        }
    }
    
    /**
     * Obtener Arreglo con el codigo SAP de Departamento de ambas estructuras.
     * 
     * @return array
     */
    private function getEstructuras()
    {
        return array(
            'actual'  => $this->util->parse('Otros/NomencladorBundle/Resources/config', 'estructura_externa_actual.yml'),
            'antigua' => $this->util->parse('Otros/NomencladorBundle/Resources/config', 'estructura_externa_antigua.yml')
        );
    }
    
    /**
     * Identificar si el departamento debe de ser procesado.
     * 
     * @param array/string $keys Unidad Organizativa (0 => Actual y 1 => Antigua).
     * @param string       $departamen_code Código Departamento.
     * @param array        $estructura Estructura Organizativa (Actual y Antigua).
     * 
     * @return boolean
     */
    private function isCorrectDepartment($keys, $departamen_code, $estructura)
    {
        $estado = \TRUE;
        
        if ($keys)
        {   
            if(!in_array($departamen_code, $estructura['actual'][$keys[0]]))
            {
                $estado = \FALSE;
            }
            if(in_array($departamen_code, $estructura['antigua'][$keys[1]]))
            {
                $estado = \TRUE;
            }
        }
        return $estado;
    }
    
    /**
     * Devolver clave a partir de acronimo para recorrer array.
     * 
     * @param type $uo Unidad Organizativa.
     * 
     * @return string
     */
    public function getKey($uo)
    {
        switch ($uo) {
            case "DTIJ":
                return array("DIVISION_TERRITORIAL_ISLA_DE_LA_JUVENTUD","DIVISION_TERRITORIAL_ISLA_DE_LA_JUVENTUD");
            case "VPP":
                return array("PRESIDENCIA","TEMPORAL");   
            case "DCDT":
                return array("DIR_CENTRAL_DE_DESARROLLO_Y_TECNOLOGIA","TEMPORAL");
            case "DCCM":
                return array("DIR_CENTRAL_DE_COMERCIAL_Y_MERCADOTECNIA","TEMPORAL");
            case "DCNI":
                return array("DIR_CENTRAL_DE_NEGOCIAC_E_IMPORTACIONES","TEMPORAL");
            case "DCCH":
                return array("DIR_CENTRAL_DE_CAPITAL_HUMANO","TEMPORAL");
            case "DCEC":
                return array("DIR_CENTRAL_DE_ECONOMIA","TEMPORAL");
            case "DCSD":
                return array("DIR_CENTRAL_DE_CONTROL_SEGUR_Y_DEFENSA","TEMPORAL");
            case "DVSM":
                return array("DIVISION_DE_SERVICIOS_MOVILES","TEMPORAL");
            case "DVSF":
                return array("DIVISION_DE_SERVICIOS_FIJOS","TEMPORAL");
            case "DVTP":
                return array("DIVISION_DE_SERVICIOS_DE_TELEF_PUBLICA","TEMPORAL");
            case "DVSI":
                return array("DIVISION_DE_SERVICIOS_INTERNACIONALES","TEMPORAL");
            case "DVTI":
                return array("DIVISION_DE_TECNOLOGIAS_DE_LA_INFORMAC","TEMPORAL");
            case "DVLS":
                return array("DIVISION_DE_LOGISTICA_Y_SERVICIOS");
            case "DVPE":
                return array("DIVISION_DE_PROYECTO_Y_EJECUC_DE_OBRAS","TEMPORAL");
            case "DVLH":
                return array("DIVISION_LA_HABANA","TEMPORAL");
            case "DTNO":
                return array("DIVISION_TERRITORIAL_NORTE","TEMPORAL");
            case "DTSP":
                return array("DIVISION_TERRITORIAL_SUR","TEMPORAL");
            case "DTES":
                return array("DIVISION_TERRITORIAL_ESTE","TEMPORAL");
            case "DTPR":
                return array("DIVISION_TERRITORIAL_PINAR_DEL_RIO","TEMPORAL");
            case "DTAR":
                return array("DIVISION_TERRITORIAL_ARTEMISA","TEMPORAL");
            case "DTMY":
                return array("DIVISION_TERRITORIAL_MAYABEQUE","TEMPORAL");
            case "DTMZ":
                return array("DIVISION_TERRITORIAL_MATANZAS","TEMPORAL");
            case "DTVC":
                return array("DIVISION_TERRITORIAL_VILLA_CLARA","TEMPORAL");
            case "DTCF":
                return array("DIVISION_TERRITORIAL_CIENFUEGOS");
            case "DTSS":
                return array("DIVISION_TERRITORIAL_SANCTI_SPIRITUS","TEMPORAL");
            case "DTCA":
                return array("DIVISION_TERRITORIAL_CIEGO_DE_AVILA","TEMPORAL");
            case "DTCM":
                return array("DIVISION_TERRITORIAL_CAMAGUEY","TEMPORAL");
            case "DTLT":
                return array("DIVISION_TERRITORIAL_LAS_TUNAS","TEMPORAL");
            case "DTHO":
                return array("DIVISION_TERRITORIAL_HOLGUIN","TEMPORAL");
            case "DTGR":
                return array("DIVISION_TERRITORIAL_GRANMA","TEMPORAL");
            case "DTSC":
                return array("DIVISION_TERRITORIAL_SANTIAGO_DE_CUBA","TEMPORAL");
            case "DTGT":
                return array("DIVISION_TERRITORIAL_GUANTANAMO","TEMPORAL");
        }
    }    
}