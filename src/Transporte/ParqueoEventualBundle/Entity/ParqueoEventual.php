<?php

namespace Transporte\ParqueoEventualBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParqueoEventual
 *
 * @ORM\Table(name="parqueo_eventual", uniqueConstraints={@ORM\UniqueConstraint(name="parqueo_eventual_fecha_emision_chofer_vehiculo_id_key", columns={"fecha_emision", "fecha_vencimiento", "chofer_vehiculo_id"})}, indexes={@ORM\Index(name="IDX_531B5F84853948F9", columns={"area_parqueo_id"}), @ORM\Index(name="IDX_531B5F84FA85302C", columns={"chofer_vehiculo_id"})})
 * @ORM\Entity
 */
class ParqueoEventual
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
     * @ORM\Column(name="fecha_emision", type="date", nullable=false)
     */
    private $fechaEmision;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vencimiento", type="date", nullable=false)
     */
    private $fechaVencimiento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="aprobado", type="boolean", nullable=true)
     */
    private $aprobado;

    /**
     * @var \Transporte\TransporteBundle\Entity\AreaParqueo
     *
     * @ORM\ManyToOne(targetEntity="\Transporte\TransporteBundle\Entity\AreaParqueo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="area_parqueo_id", referencedColumnName="id")
     * })
     */
    private $areaParqueo;

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
     * Set fechaEmision
     *
     * @param \DateTime $fechaEmision
     * @return ParqueoEventual
     */
    public function setFechaEmision($fechaEmision)
    {
        $this->fechaEmision = $fechaEmision;

        return $this;
    }

    /**
     * Get fechaEmision
     *
     * @return \DateTime 
     */
    public function getFechaEmision()
    {
        return $this->fechaEmision;
    }

    /**
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     * @return ParqueoEventual
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \DateTime 
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set aprobado
     *
     * @param boolean $aprobado
     * @return ParqueoEventual
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
     * Set areaParqueo
     *
     * @param \Transporte\TransporteBundle\Entity\AreaParqueo $areaParqueo
     * @return ParqueoEventual
     */
    public function setAreaParqueo(\Transporte\TransporteBundle\Entity\AreaParqueo $areaParqueo = null)
    {
        $this->areaParqueo = $areaParqueo;

        return $this;
    }

    /**
     * Get areaParqueo
     *
     * @return \Transporte\TransporteBundle\Entity\AreaParqueo 
     */
    public function getAreaParqueo()
    {
        return $this->areaParqueo;
    }

    /**
     * Set choferVehiculo
     *
     * @param \Transporte\TransporteBundle\Entity\ChoferVehiculo $choferVehiculo
     * @return ParqueoEventual
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
