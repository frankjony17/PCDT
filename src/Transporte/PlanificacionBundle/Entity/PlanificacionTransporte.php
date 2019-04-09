<?php

namespace Transporte\PlanificacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanificacionTransporte
 *
 * @ORM\Table(name="planificacion_transporte", uniqueConstraints={@ORM\UniqueConstraint(name="planificacion_transporte_fecha_chofer_vehiculo_id_key", columns={"fecha", "chofer_vehiculo_id"})}, indexes={@ORM\Index(name="IDX_CD8DC9DBFA85302C", columns={"chofer_vehiculo_id"})})
 * @ORM\Entity
 */
class PlanificacionTransporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicial", type="time", nullable=false)
     */
    private $horaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_final", type="time", nullable=false)
     */
    private $horaFinal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="aprobado", type="boolean", nullable=false)
     */
    private $aprobado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pendiente", type="boolean", nullable=true)
     */
    private $pendiente;

    /**
     * @var string
     *
     * @ORM\Column(name="tarea", type="string", length=255, nullable=false)
     */
    private $tarea;

    /**
     * @var string
     *
     * @ORM\Column(name="recorrido", type="string", length=255, nullable=false)
     */
    private $recorrido;

    /**
     * @var \Transporte\TransporteBundle\Entity\ChoferVehiculo
     *
     * @ORM\ManyToOne(targetEntity="\Transporte\TransporteBundle\Entity\ChoferVehiculo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chofer_vehiculo_id", referencedColumnName="id")
     * })
     */
    private $choferVehiculo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Plantilla", mappedBy="planificacionTransporte")
     */
    private $plantilla;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plantilla = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return PlanificacionTransporte
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set horaInicial
     *
     * @param \DateTime $horaInicial
     * @return PlanificacionTransporte
     */
    public function setHoraInicial($horaInicial)
    {
        $this->horaInicial = $horaInicial;

        return $this;
    }

    /**
     * Get horaInicial
     *
     * @return \DateTime 
     */
    public function getHoraInicial()
    {
        return $this->horaInicial;
    }

    /**
     * Set horaFinal
     *
     * @param \DateTime $horaFinal
     * @return PlanificacionTransporte
     */
    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }

    /**
     * Get horaFinal
     *
     * @return \DateTime 
     */
    public function getHoraFinal()
    {
        return $this->horaFinal;
    }

    /**
     * Set aprobado
     *
     * @param boolean $aprobado
     * @return PlanificacionTransporte
     */
    public function setAprobado($aprobado)
    {
        $this->aprobado = $aprobado;

        return $this;
    }

    /**
     * Get aprobado
     *
     * @return boolean 
     */
    public function getAprobado()
    {
        return $this->aprobado;
    }

    /**
     * Set pendiente
     *
     * @param boolean $pendiente
     * @return PlanificacionTransporte
     */
    public function setPendiente($pendiente)
    {
        $this->pendiente = $pendiente;

        return $this;
    }

    /**
     * Get pendiente
     *
     * @return boolean 
     */
    public function getPendiente()
    {
        return $this->pendiente;
    }

    /**
     * Set tarea
     *
     * @param string $tarea
     * @return PlanificacionTransporte
     */
    public function setTarea($tarea)
    {
        $this->tarea = $tarea;

        return $this;
    }

    /**
     * Get tarea
     *
     * @return string 
     */
    public function getTarea()
    {
        return $this->tarea;
    }

    /**
     * Set recorrido
     *
     * @param string $recorrido
     * @return PlanificacionTransporte
     */
    public function setRecorrido($recorrido)
    {
        $this->recorrido = $recorrido;

        return $this;
    }

    /**
     * Get recorrido
     *
     * @return string 
     */
    public function getRecorrido()
    {
        return $this->recorrido;
    }

    /**
     * Set choferVehiculo
     *
     * @param \Transporte\TransporteBundle\Entity\ChoferVehiculo $choferVehiculo
     * @return PlanificacionTransporte
     */
    public function setChoferVehiculo(\Transporte\TransporteBundle\Entity\ChoferVehiculo $choferVehiculo = null)
    {
        $this->choferVehiculo = $choferVehiculo;

        return $this;
    }

    /**
     * Get choferVehiculo
     *
     * @return \Transporte\TransporteBundle\Entity\ChoferVehiculo 
     */
    public function getChoferVehiculo()
    {
        return $this->choferVehiculo;
    }

    /**
     * Add plantilla
     *
     * @param \Transporte\PlanificacionBundle\Entity\Plantilla $plantilla
     * @return PlanificacionTransporte
     */
    public function addPlantilla(\Transporte\PlanificacionBundle\Entity\Plantilla $plantilla)
    {
        $this->plantilla[] = $plantilla;

        return $this;
    }

    /**
     * Remove plantilla
     *
     * @param \Transporte\PlanificacionBundle\Entity\Plantilla $plantilla
     */
    public function removePlantilla(\Transporte\PlanificacionBundle\Entity\Plantilla $plantilla)
    {
        $this->plantilla->removeElement($plantilla);
    }

    /**
     * Get plantilla
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlantilla()
    {
        return $this->plantilla;
    }
}
