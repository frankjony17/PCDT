<?php

namespace Transporte\PlanificacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plantilla
 *
 * @ORM\Table(name="plantilla", uniqueConstraints={@ORM\UniqueConstraint(name="plantilla_nombre_key", columns={"nombre"})}, indexes={@ORM\Index(name="IDX_769DF253A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Plantilla
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
     * @ORM\Column(name="nombre", type="string", length=32, nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="\Seguridad\AdminBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="PlanificacionTransporte", inversedBy="plantilla")
     * @ORM\JoinTable(name="plantilla_planificacion_transporte",
     *   joinColumns={
     *     @ORM\JoinColumn(name="plantilla_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="planificacion_transporte_id", referencedColumnName="id")
     *   }
     * )
     */
    private $planificacionTransporte;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->planificacionTransporte = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Plantilla
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Plantilla
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
     * Get user
     *
     * @return \Seguridad\AdminBundle\Entity\Users 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Get planificacionTransporte
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlanificacionTransporte()
    {
        return $this->planificacionTransporte;
    }
}
