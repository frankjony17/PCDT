<?php

namespace Transporte\TransporteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SituacionOperativa
 *
 * @ORM\Table(name="situacion_operativa", uniqueConstraints={@ORM\UniqueConstraint(name="situacion_operativa_descripcion_key", columns={"descripcion"}), @ORM\UniqueConstraint(name="situacion_operativa_nombre_key", columns={"nombre"})})
 * @ORM\Entity
 */
class SituacionOperativa
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
     * @ORM\Column(name="nombre", type="string", length=25, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=120, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Vehiculo", mappedBy="situacionOperativa")
     */
    private $vehiculo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehiculo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return SituacionOperativa
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
     * @return SituacionOperativa
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
     * Add vehiculo
     *
     * @param \Transporte\TransporteBundle\Entity\Vehiculo $vehiculo
     * @return SituacionOperativa
     */
    public function addVehiculo(\Transporte\TransporteBundle\Entity\Vehiculo $vehiculo)
    {
        $this->vehiculo[] = $vehiculo;

        return $this;
    }

    /**
     * Remove vehiculo
     *
     * @param \Transporte\TransporteBundle\Entity\Vehiculo $vehiculo
     */
    public function removeVehiculo(\Transporte\TransporteBundle\Entity\Vehiculo $vehiculo)
    {
        $this->vehiculo->removeElement($vehiculo);
    }

    /**
     * Get vehiculo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehiculo()
    {
        return $this->vehiculo;
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
            'descripcion' => $this->descripcion
        );
    }    
}
