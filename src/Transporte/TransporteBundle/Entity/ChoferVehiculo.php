<?php

namespace Transporte\TransporteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChoferVehiculo
 *
 * @ORM\Table(name="chofer_vehiculo", uniqueConstraints={@ORM\UniqueConstraint(name="chofer_vehiculo_chofer_id_permanente_key", columns={"chofer_id", "permanente"}), @ORM\UniqueConstraint(name="chofer_vehiculo_chofer_id_vehiculo_id_key", columns={"chofer_id", "vehiculo_id"})}, indexes={@ORM\Index(name="IDX_7F453F32A5E4E82", columns={"chofer_id"}), @ORM\Index(name="IDX_7F453F325F7D575", columns={"vehiculo_id"})})
 * @ORM\Entity
 */
class ChoferVehiculo
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
     * @var boolean
     *
     * @ORM\Column(name="permanente", type="boolean", nullable=true)
     */
    private $permanente;

    /**
     * @var \Chofer
     *
     * @ORM\ManyToOne(targetEntity="Chofer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chofer_id", referencedColumnName="id")
     * })
     */
    private $chofer;

    /**
     * @var \Vehiculo
     *
     * @ORM\ManyToOne(targetEntity="Vehiculo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehiculo_id", referencedColumnName="id")
     * })
     */
    private $vehiculo;

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
     * Set permanente
     *
     * @param boolean $permanente
     * @return ChoferVehiculo
     */
    public function setPermanente($permanente)
    {
        $this->permanente = $permanente;

        return $this;
    }

    /**
     * Get permanente
     *
     * @return boolean 
     */
    public function getPermanente()
    {
        return $this->permanente;
    }

    /**
     * Set chofer
     *
     * @param \Transporte\TransporteBundle\Entity\Chofer $chofer
     * @return ChoferVehiculo
     */
    public function setChofer(\Transporte\TransporteBundle\Entity\Chofer $chofer = null)
    {
        $this->chofer = $chofer;

        return $this;
    }

    /**
     * Get chofer
     *
     * @return \Transporte\TransporteBundle\Entity\Chofer 
     */
    public function getChofer()
    {
        return $this->chofer;
    }

    /**
     * Set vehiculo
     *
     * @param \Transporte\TransporteBundle\Entity\Vehiculo $vehiculo
     * @return ChoferVehiculo
     */
    public function setVehiculo(\Transporte\TransporteBundle\Entity\Vehiculo $vehiculo = null)
    {
        $this->vehiculo = $vehiculo;

        return $this;
    }

    /**
     * Get vehiculo
     *
     * @return \Transporte\TransporteBundle\Entity\Vehiculo 
     */
    public function getVehiculo()
    {
        return $this->vehiculo;
    }
}
