<?php

namespace Transporte\ControlParqueoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agente
 *
 * @ORM\Table(name="agente", uniqueConstraints={@ORM\UniqueConstraint(name="agente_nombre_apellidos_key", columns={"nombre_apellidos"})})
 * @ORM\Entity
 */
class Agente
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
     * @ORM\Column(name="nombre_apellidos", type="string", length=50, nullable=false)
     */
    private $nombreApellidos;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ControlTransporte", inversedBy="agente")
     * @ORM\JoinTable(name="agente_control_transporte",
     *   joinColumns={
     *     @ORM\JoinColumn(name="agente_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="control_transporte_id", referencedColumnName="id")
     *   }
     * )
     */
    private $controlTransporte;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->controlTransporte = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombreApellidos
     *
     * @param string $nombreApellidos
     * @return Agente
     */
    public function setNombreApellidos($nombreApellidos)
    {
        $this->nombreApellidos = $nombreApellidos;

        return $this;
    }

    /**
     * Get nombreApellidos
     *
     * @return string 
     */
    public function getNombreApellidos()
    {
        return $this->nombreApellidos;
    }

    /**
     * Add controlTransporte
     *
     * @param \Transporte\ControlParqueoBundle\Entity\ControlTransporte $controlTransporte
     * @return Agente
     */
    public function addControlTransporte(\Transporte\ControlParqueoBundle\Entity\ControlTransporte $controlTransporte)
    {
        $this->controlTransporte[] = $controlTransporte;

        return $this;
    }

    /**
     * Remove controlTransporte
     *
     * @param \Transporte\ControlParqueoBundle\Entity\ControlTransporte $controlTransporte
     */
    public function removeControlTransporte(\Transporte\ControlParqueoBundle\Entity\ControlTransporte $controlTransporte)
    {
        $this->controlTransporte->removeElement($controlTransporte);
    }

    /**
     * Get controlTransporte
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getControlTransporte()
    {
        return $this->controlTransporte;
    }
}
