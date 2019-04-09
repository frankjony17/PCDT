<?php

namespace Transporte\TransporteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matricula
 *
 * @ORM\Table(name="matricula", uniqueConstraints={@ORM\UniqueConstraint(name="matricula_chapa_key", columns={"chapa"})})
 * @ORM\Entity(repositoryClass="Transporte\TransporteBundle\Entity\MatriculaRepository")
 */
class Matricula
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="decimal", precision=10, scale=0, nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="chapa", type="string", length=20, nullable=false)
     */
    private $chapa;

    /**
     * @var string
     *
     * @ORM\Column(name="chapa_vieja", type="string", length=20, nullable=true)
     */
    private $chapaVieja;

    /**
     * @var string
     *
     * @ORM\Column(name="circulacion", type="string", length=20, nullable=true)
     */
    private $circulacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencimiento", type="date", nullable=true)
     */
    private $vencimiento;

    /**
     * @var \Vehiculo
     *
     * @ORM\OneToOne(targetEntity="Vehiculo", mappedBy="matricula")
     */
    private $vehiculo;
    
    /**
     * Set id
     *
     * @return Matricula
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    
    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set chapa
     *
     * @param string $chapa
     * @return Matricula
     */
    public function setChapa($chapa)
    {
        $this->chapa = $chapa;

        return $this;
    }

    /**
     * Get chapa
     *
     * @return string 
     */
    public function getChapa()
    {
        return $this->chapa;
    }

    /**
     * Set chapaVieja
     *
     * @param string $chapaVieja
     * @return Matricula
     */
    public function setChapaVieja($chapaVieja)
    {
        $this->chapaVieja = $chapaVieja;

        return $this;
    }

    /**
     * Get chapaVieja
     *
     * @return string 
     */
    public function getChapaVieja()
    {
        return $this->chapaVieja;
    }

    /**
     * Set circulacion
     *
     * @param string $circulacion
     * @return Matricula
     */
    public function setCirculacion($circulacion)
    {
        $this->circulacion = $circulacion;

        return $this;
    }

    /**
     * Get circulacion
     *
     * @return string 
     */
    public function getCirculacion()
    {
        return $this->circulacion;
    }

    /**
     * Set vencimiento
     *
     * @param \DateTime $vencimiento
     * @return Matricula
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    /**
     * Get vencimiento
     *
     * @return \DateTime 
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
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
            'chapa' => $this->chapa,
            'chapaVieja' => $this->chapaVieja,
            'circulacion' => $this->circulacion,
            'vencimiento' => $this->vencimiento ? date_format($this->vencimiento, 'Y-m-d') : "No definida."
        );
    }
}
