<?php

namespace Indicadores\IndicadorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndArc
 *
 * @ORM\Table(name="ind_arc", uniqueConstraints={@ORM\UniqueConstraint(name="ind_arc_descripcion_fecha_key", columns={"descripcion", "fecha"}), @ORM\UniqueConstraint(name="ind_arc_nombre_fecha_key", columns={"nombre", "fecha"})})
 * @ORM\Entity
 */
class IndArc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ind_arc_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=25, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="fecha", type="integer", nullable=false)
     */
    private $fecha;



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
     * Set nombre
     *
     * @param string $nombre
     * @return IndArc
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return IndArc
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
     * Set fecha
     *
     * @param integer $fecha
     * @return IndArc
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return integer 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Get Array Row
     *
     * @return array
     */
    public function toArray()
    {
        return array
        (
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha' => $this->fecha
        );
    }
}
