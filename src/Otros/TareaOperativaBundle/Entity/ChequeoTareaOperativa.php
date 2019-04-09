<?php

namespace Otros\TareaOperativaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChequeoTareaOperativa
 *
 * @ORM\Table(name="chequeo_tarea_operativa", uniqueConstraints={@ORM\UniqueConstraint(name="chequeo_tarea_operativa_periodo_tarea_operativa_id_key", columns={"periodo", "tarea_operativa_id"})}, indexes={@ORM\Index(name="IDX_D02FCF294D25E70E", columns={"tarea_operativa_id"})})
 * @ORM\Entity
 */
class ChequeoTareaOperativa
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
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodo", type="integer", nullable=false)
     */
    private $periodo;

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
     * Set periodo
     *
     * @param integer $periodo
     * @return ChequeoTareaOperativa
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return integer 
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Get periodo en dias
     *
     * @return string
     */
    public function getStringPeriodo()
    {
        switch ($this->periodo)
        {
            case 1:
                return "Monday";
            case 2:
                return "Tuesday";
            case 3:
                return "Wednesday";
            case 4:
                return "Thursday";
            case 5:
                return "Friday";
            default:
                return $this->periodo;
        }
    }

    /**
     * Set tareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\TareaOperativa $tareaOperativa
     * @return ChequeoTareaOperativa
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
