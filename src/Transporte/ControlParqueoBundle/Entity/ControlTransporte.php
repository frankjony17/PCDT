<?php

namespace Transporte\ControlParqueoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControlTransporte
 *
 * @ORM\Table(name="control_transporte", uniqueConstraints={@ORM\UniqueConstraint(name="control_transporte_fecha_chofer_vehiculo_id_key", columns={"fecha", "chofer_vehiculo_id"})}, indexes={@ORM\Index(name="IDX_7EAEBE6DFA85302C", columns={"chofer_vehiculo_id"})})
 * @ORM\Entity
 */
class ControlTransporte
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
     * @ORM\Column(name="hora_salida", type="time", nullable=false)
     */
    private $horaSalida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_entrada", type="time", nullable=false)
     */
    private $horaEntrada;

    /**
     * @var boolean
     *
     * @ORM\Column(name="autorizado", type="boolean", nullable=false)
     */
    private $autorizado;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=45, nullable=true)
     */
    private $observaciones;

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
     * @ORM\ManyToMany(targetEntity="Agente", mappedBy="controlTransporte")
     */
    private $agente;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->agente = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ControlTransporte
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
     * Set horaSalida
     *
     * @param \DateTime $horaSalida
     * @return ControlTransporte
     */
    public function setHoraSalida($horaSalida)
    {
        $this->horaSalida = $horaSalida;

        return $this;
    }

    /**
     * Get horaSalida
     *
     * @return \DateTime 
     */
    public function getHoraSalida()
    {
        return $this->horaSalida;
    }

    /**
     * Set horaEntrada
     *
     * @param \DateTime $horaEntrada
     * @return ControlTransporte
     */
    public function setHoraEntrada($horaEntrada)
    {
        $this->horaEntrada = $horaEntrada;

        return $this;
    }

    /**
     * Get horaEntrada
     *
     * @return \DateTime 
     */
    public function getHoraEntrada()
    {
        return $this->horaEntrada;
    }

    /**
     * Set autorizado
     *
     * @param boolean $autorizado
     * @return ControlTransporte
     */
    public function setAutorizado($autorizado)
    {
        $this->autorizado = $autorizado;

        return $this;
    }

    /**
     * Get autorizado
     *
     * @return boolean 
     */
    public function getAutorizado()
    {
        return $this->autorizado;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return ControlTransporte
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set choferVehiculo
     *
     * @param \Transporte\TransporteBundle\Entity\ChoferVehiculo $choferVehiculo
     * @return ControlTransporte
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
     * Add agente
     *
     * @param \Transporte\ControlParqueoBundle\Entity\Agente $agente
     * @return ControlTransporte
     */
    public function addAgente(\Transporte\ControlParqueoBundle\Entity\Agente $agente)
    {
        $this->agente[] = $agente;

        return $this;
    }

    /**
     * Remove agente
     *
     * @param \Transporte\ControlParqueoBundle\Entity\Agente $agente
     */
    public function removeAgente(\Transporte\ControlParqueoBundle\Entity\Agente $agente)
    {
        $this->agente->removeElement($agente);
    }

    /**
     * Get agente
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAgente()
    {
        return $this->agente;
    }
}
