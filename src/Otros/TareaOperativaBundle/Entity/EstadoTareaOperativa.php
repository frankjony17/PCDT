<?php

namespace Otros\TareaOperativaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoTareaOperativa
 *
 * @ORM\Table(name="estado_tarea_operativa", uniqueConstraints={@ORM\UniqueConstraint(name="estado_tarea_operativa_estado_fecha_final_tarea_operativa_i_key", columns={"estado", "fecha_final", "tarea_operativa_id"})}, indexes={@ORM\Index(name="IDX_A8DE0E44D25E70E", columns={"tarea_operativa_id"})})
 * @ORM\Entity
 */
class EstadoTareaOperativa
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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=false)
     */
    private $fechaFinal;

    /**
     * @var \TareaOperativa
     *
     * @ORM\ManyToOne(targetEntity="TareaOperativa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tarea_operativa_id", referencedColumnName="id")
     * })
     */
    private $tareaOperativa;

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
     * @return EstadoTareaOperativa
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
     * Set estado
     *
     * @param string $estado
     * @return EstadoTareaOperativa
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     * @return EstadoTareaOperativa
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
     * Set tareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\TareaOperativa $tareaOperativa
     * @return EstadoTareaOperativa
     */
    public function setTareaOperativa(\Otros\TareaOperativaBundle\Entity\TareaOperativa $tareaOperativa = null)
    {
        $this->tareaOperativa = $tareaOperativa;

        return $this;
    }

    /**
     * Get tareaOperativa
     *
     * @return \Otros\TareaOperativaBundle\Entity\TareaOperativa 
     */
    public function getTareaOperativa()
    {
        return $this->tareaOperativa;
    }
}
