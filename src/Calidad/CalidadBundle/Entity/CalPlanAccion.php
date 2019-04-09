<?php

namespace Calidad\CalidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalPlanAccion
 *
 * @ORM\Table(name="cal_plan_accion", indexes={@ORM\Index(name="IDX_1A39AED0E4B82543", columns={"brechas_otros_id"})})
 * @ORM\Entity
 */
class CalPlanAccion
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

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
     * @var \CalBrechasOtros
     *
     * @ORM\ManyToOne(targetEntity="CalBrechasOtros", inversedBy="planAccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="brechas_otros_id", referencedColumnName="id")
     * })
     */
    private $brechasOtros;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;

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
     * Set descripcion
     *
     * @param string $descripcion
     * @return CalPlanAccion
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
     * Set fechaInicial
     *
     * @param \DateTime $fechaInicial
     * @return CalPlanAccion
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
     * @return CalPlanAccion
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
     * Set estado
     *
     * @param boolean $estado
     * @return CalPlanAccion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set brechasOtros
     *
     * @param \Calidad\CalidadBundle\Entity\CalBrechasOtros $brechasOtros
     * @return CalPlanAccion
     */
    public function setBrechasOtros(\Calidad\CalidadBundle\Entity\CalBrechasOtros $brechasOtros = null)
    {
        $this->brechasOtros = $brechasOtros;

        return $this;
    }

    /**
     * Get brechasOtros
     *
     * @return \Calidad\CalidadBundle\Entity\CalBrechasOtros 
     */
    public function getBrechasOtros()
    {
        return $this->brechasOtros;
    }

    /**
     * Get Array Row
     *
     * @return array
     */
    public function toArray()
    {
        return array (
            'id' => $this->id,
            'descripcion' => $this->getDescripcion(),
            'fechainicial' => $this->getFechaInicial()->format("Y-m-d"),
            'fechafinal' => $this->getFechaFinal()->format("Y-m-d"),
            'estado' => $this->getEstado(),
        );
    }
}
