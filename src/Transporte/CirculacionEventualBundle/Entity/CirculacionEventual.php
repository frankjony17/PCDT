<?php

namespace Transporte\CirculacionEventualBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CirculacionEventual
 *
 * @ORM\Table(name="circulacion_eventual", uniqueConstraints={@ORM\UniqueConstraint(name="circulacion_eventual_fecha_inicial_fecha_final_chofer_vehic_key", columns={"fecha_inicial", "fecha_final", "chofer_vehiculo_id"})}, indexes={@ORM\Index(name="IDX_2574F0D0FA85302C", columns={"chofer_vehiculo_id"})})
 * @ORM\Entity
 */
class CirculacionEventual
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
     * @ORM\Column(name="fecha_inicial", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=false)
     */
    private $fechaFinal;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaInicial
     *
     * @param \DateTime $fechaInicial
     * @return CirculacionEventual
     */
    public function setFechaInicial($fechaInicial)
    {
        $this->fechaInicial = $fechaInicial;

        return $this;
    }

    /**
     * Get fechaInicial
     *
     * @return \DateTime 
     */
    public function getFechaInicial()
    {
        return $this->fechaInicial;
    }

    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     * @return CirculacionEventual
     */
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime 
     */
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    /**
     * Set horaInicial
     *
     * @param \DateTime $horaInicial
     * @return CirculacionEventual
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
     * @return CirculacionEventual
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
     * @return CirculacionEventual
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
     * @return CirculacionEventual
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
     * @return CirculacionEventual
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
     * @return CirculacionEventual
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
     * @return CirculacionEventual
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
}
