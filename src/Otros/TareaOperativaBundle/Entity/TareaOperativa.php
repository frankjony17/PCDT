<?php

namespace Otros\TareaOperativaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * TareaOperativa
 *
 * @ORM\Table(name="tarea_operativa", uniqueConstraints={@ORM\UniqueConstraint(name="tarea_operativa_fecha_creacion_descripcion_key", columns={"fecha_creacion", "descripcion"})})
 * @ORM\Entity(repositoryClass="Otros\TareaOperativaBundle\Entity\TareaOperativaRepository")
 */
class TareaOperativa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tarea_operativa_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;    

    /**
     * @var \EstadoTareaOperativa
     *
     * @ORM\OneToMany(targetEntity="EstadoTareaOperativa", mappedBy="tareaOperativa")
     */
    private $estadoTareaOperativa;
    
    /**
     * @var TareaOperativaTrabajador
     *
     * @ORM\OneToMany(targetEntity="TareaOperativaTrabajador", mappedBy="tareaOperativa")
     */
    private $tareaOperativaTrabajador;
    
    /**
     * @var \AccionTareaOperativa
     *
     * @ORM\OneToMany(targetEntity="AccionTareaOperativa", mappedBy="tareaOperativa")
     */
    private $accionTareaOperativa;
    
    /**
     * @var \ChequeoTareaOperativa
     *
     * @ORM\OneToMany(targetEntity="ChequeoTareaOperativa", mappedBy="tareaOperativa")
     */
    private $chequeoTareaOperativa;    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estadoTareaOperativa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tareaOperativaTrabajador = new \Doctrine\Common\Collections\ArrayCollection();
        $this->accionTareaOperativa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->chequeoTareaOperativa = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return TareaOperativa
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return TareaOperativa
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return TareaOperativa
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        if ($this->numero < 10)
        {
            $ceros = '00';
        }
        else if ($this->numero < 100)
        {
            $ceros = '0';
        }
        else
        {
            $ceros = '';
        }
        return $ceros.''.$this->numero;
    }    
    
    /**
     * Add estadoTareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\EstadoTareaOperativa $estadoTareaOperativa
     * @return TareaOperativa
     */
    public function addEstadoTareaOperativa(\Otros\TareaOperativaBundle\Entity\EstadoTareaOperativa $estadoTareaOperativa)
    {
        $this->estadoTareaOperativa[] = $estadoTareaOperativa;

        return $this;
    }

    /**
     * Remove estadoTareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\EstadoTareaOperativa $estadoTareaOperativa
     */
    public function removeEstadoTareaOperativa(\Otros\TareaOperativaBundle\Entity\EstadoTareaOperativa $estadoTareaOperativa)
    {
        $this->estadoTareaOperativa->removeElement($estadoTareaOperativa);
    }

    /**
     * Get estadoTareaOperativa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstadoTareaOperativa()
    {
        return $this->estadoTareaOperativa;
    }
    
    /**
     * Add tareaOperativaTrabajador
     *
     * @param \Otros\TareaOperativaBundle\Entity\TareaOperativaTrabajador $tareaOperativaTrabajador
     * @return TareaOperativa
     */
    public function addTareaOperativaTrabajador(\Otros\TareaOperativaBundle\Entity\TareaOperativaTrabajador $tareaOperativaTrabajador)
    {
        $this->tareaOperativaTrabajador[] = $tareaOperativaTrabajador;

        return $this;
    }

    /**
     * Remove tareaOperativaTrabajador
     *
     * @param \Otros\TareaOperativaBundle\Entity\TareaOperativaTrabajador $tareaOperativaTrabajador
     */
    public function removeTareaOperativaTrabajador(\Otros\TareaOperativaBundle\Entity\TareaOperativaTrabajador $tareaOperativaTrabajador)
    {
        $this->tareaOperativaTrabajador->removeElement($tareaOperativaTrabajador);
    }

    /**
     * Get tareaOperativaTrabajador
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTareaOperativaTrabajador()
    {
        return $this->tareaOperativaTrabajador;
    }
    
    /**
     * Get last estado from TareaOperativa
     *
     * @return array
     */
    public function getLastEstadoTareaOperativa()
    {
        $fechaFinal = new \DateTime(date("Y-m-d"));
        $estadoFinal = "";
        $fechaRegistro = new \DateTime("2014-01-01");
        
        foreach ($this->estadoTareaOperativa as $estado)
        {
            if ($estado->getFecha() > $fechaRegistro)
            {
                $fechaFinal = $estado->getFechaFinal();
                $estadoFinal = $estado->getEstado();
            }
        }
        return array($fechaFinal, $estadoFinal);
    }

    /**
     * Fecha final
     * @return string
     */
    public function getFechaFinal()
    {
        $fechaFinal = new \DateTime(date("Y-m-d"));
        $fechaRegistro = new \DateTime("2000-01-01");

        foreach ($this->estadoTareaOperativa as $estado)
        {
            if ($estado->getFecha() > $fechaRegistro)
            {
                $fechaFinal = $estado->getFechaFinal();
            }
        }
        return $fechaFinal->format("Y-m-d");
    }
    
    /**
     * Add accionTareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\AccionTareaOperativa $accionTareaOperativa
     * @return TareaOperativa
     */
    public function addAccionTareaOperativa(\Otros\TareaOperativaBundle\Entity\AccionTareaOperativa $accionTareaOperativa)
    {
        $this->accionTareaOperativa[] = $accionTareaOperativa;

        return $this;
    }

    /**
     * Remove accionTareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\AccionTareaOperativa $accionTareaOperativa
     */
    public function removeAccionTareaOperativa(\Otros\TareaOperativaBundle\Entity\AccionTareaOperativa $accionTareaOperativa)
    {
        $this->accionTareaOperativa->removeElement($accionTareaOperativa);
    }

    /**
     * Get accionTareaOperativa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccionTareaOperativa()
    {
        return $this->accionTareaOperativa;
    }
    
    /**
     * Add chequeoTareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\ChequeoTareaOperativa $chequeoTareaOperativa
     * @return TareaOperativa
     */
    public function addChequeoTareaOperativa(\Otros\TareaOperativaBundle\Entity\ChequeoTareaOperativa $chequeoTareaOperativa)
    {
        $this->chequeoTareaOperativa[] = $chequeoTareaOperativa;

        return $this;
    }

    /**
     * Remove chequeoTareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\ChequeoTareaOperativa $chequeoTareaOperativa
     */
    public function removeChequeoTareaOperativa(\Otros\TareaOperativaBundle\Entity\ChequeoTareaOperativa $chequeoTareaOperativa)
    {
        $this->chequeoTareaOperativa->removeElement($chequeoTareaOperativa);
    }

    /**
     * Get chequeoTareaOperativa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChequeoTareaOperativa()
    {
        return $this->chequeoTareaOperativa;
    }
    
    /**
     * Get Array Row
     *
     * @return array 
     */    
    public function toArray($val)
    {
        $lastEstado = $this->getLastEstadoTareaOperativa();
        $fechaFinal = $lastEstado[0];
        $estadoFinal = $lastEstado[1];

        $array = $this->getAreaResponsableAndTrabajadorId();
        $accion_info = $this->accionesHtml($val);
        return array
        (
            'id' => $this->id,
            'numero' => $this->getNumeroTarea(),
            'responsable' => $array[0],
            'descripcion' => $this->getDescripcion(),
            'chequeo' => $this->getPeriodoDeChequeo(),
            'fecha_inicial' => $this->getFechaCreacion()->format("Y-m-d"),
            'fecha_final' => $fechaFinal->format("Y-m-d"),
            'estado' => $estadoFinal,
            'acciones' => $accion_info[0],
            'trabajadores_ids' => $array[1],
            "accion" => is_array($accion_info[1]) ? $accion_info[1]["desc"] : "",
            "accion_id" => is_array($accion_info[1]) ? $accion_info[1]["id"] : ""
        );
    }
    
    /**
     * Get Área Responsable and Trabajador ID .
     *
     * @return string 
     */
    public function getAreaResponsableAndTrabajadorId()
    {
        $responsables = ""; $trabajadorId = '';
        
        foreach ($this->getTareaOperativaTrabajador() as $trabajador)
        {
            if($trabajador->getPendiente() === \TRUE)
            {
                $area = '<b><u><i>'. $trabajador->getTrabajador()->getArea()->getNombre() .'</u></i></b>';
            }
            else
            {
                $area = $trabajador->getTrabajador()->getArea()->getNombre();
            }
            $responsables .= $area. ', ';
            $trabajadorId .= $trabajador->getTrabajador()->getId() .'-';
        }
        return array(rtrim($responsables, ", "), rtrim($trabajadorId, "-"));
    }

    /**
     * @return string
     */
    private function accionesHtml ($value)
    {
        if ($value === "")
        {
            $html = '<table><tr><th><div class="tablestayle"><table><thead><tr><th>Fecha</th><th>Acciones Realizadas</th><th></th></tr></thead><tbody>';
        } else {
            $html = '<table><tr><th><div class="tablestayle"><table><thead><tr><th>Fecha</th><th>Acciones Realizadas</th></tr></thead><tbody>';
        }
        $temp = array(); $i = 0;

        if (count($array = $this->getAcciones()) > 0)
        {
            foreach($array as $val)
            {
                $link =  '<img src="/images/edit.png" onclick="showWindowsAccion(\''. $val["id"] .'-|#|-'. $val["descripcion"] .'\')">';

                if ($i === 0)
                {
                    $temp["id"] = $val["id"];
                    $temp["desc"] = $val["descripcion"];
                }
                if ($value === "")
                {
                    $html .= '<tr><td>'.$val["fecha"].'</td><td>'.$val["descripcion"].'</td><td>'.$link.'</td></tr>';
                } else {
                    $html .= '<tr><td>'.$val["fecha"].'</td><td>'.$val["descripcion"].'</td></tr>';
                }
                $i++;
            }
            return array($html .= '</tbody></table></div></th></tr></table>', $temp);
        }
        return array("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Acciones: 0</b>", false);
    }
    
    /**
     * Get chequeoTareaOperativa.
     * 
     * @return type
     */
    private function getPeriodoDeChequeo()
    {
        $chequeoTareaOperativa = "";
        foreach ($this->getChequeoTareaOperativa() as $periodoChequeo)
        {
            $chequeoTareaOperativa .= $this->getPeriodo($periodoChequeo->getPeriodo()) .", ";
        }
        return rtrim($chequeoTareaOperativa, ", ");
    }

    /**
     * Get accionTareaOperativa
     *
     * @return string
     */
    private function getAcciones()
    {
        $count = 3;
        $action_tarea = array();
        $action_tarea_operativa = array();

        foreach ($this->getAccionTareaOperativa() as $actions)
        {
            $action_tarea_operativa[] = $actions->toArray();
        }
        array_multisort($action_tarea_operativa, SORT_DESC);

        if (count($action_tarea_operativa) > 0)
        {
            $count > count($action_tarea_operativa) ? $count = count($action_tarea_operativa) : false;

            for ($i = 0; $i < $count; $i++)
            {
                $action_tarea[] = array(
                    "id" => $action_tarea_operativa[$i]["id"],
                    "fecha" => $action_tarea_operativa[$i]["fecha"],
                    "descripcion" => $action_tarea_operativa[$i]["descripcion"],
                );
            }
        }
        return $action_tarea;
    }

    /**
     * Get periodo from chequeoTareaOperativa
     * 
     * @param Integer $periodo
     * @return String
     */
    private function getPeriodo($periodo)
    {
        switch ($periodo) {
            case 0:
                return "Diario";
            case 1:
                return "Lun";
            case 2:
                return "Mar";
            case 3:
                return "Mié";
            case 4:
                return "Jue";
            case 5:
                return "Vie";
            case 6:
                return "<b>(Q)</b>";
            default:
                return "<b>(M)</b>";
        }
    }

    /**
     * Get Numero de Tarea Operativa.
     *
     * @return string
     */
    public function getNumeroTarea ()
    {
        return 'TO-'.$this->getFechaCreacion()->format('Y').'-'.$this->getNumero();
    }

    /**
     * @return array
     */
    public function getDataChartBar ()
    {
        $estado = $this->getLastEstadoTareaOperativa();
        // DateTime object.
        $fecha_Final = $estado[0];
        $fecha_hoy = new \DateTime(date('Y-m-d'));

        return array(
            'pendiente'    => $estado[1] === 'Pendiente' ? true : false,
            'ultimodia'    => $fecha_Final->format('Y-m-d') === date('Y-m-d') ? true : false,
            'fueratermino' => $fecha_Final < $fecha_hoy ? true : false
        );
    }
}