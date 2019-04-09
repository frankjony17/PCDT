<?php

namespace Transporte\TransporteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehiculo
 *
 * @ORM\Table(name="vehiculo", indexes={@ORM\Index(name="IDX_C9FA1603BD0F409C", columns={"area_id"}), @ORM\Index(name="IDX_C9FA1603853948F9", columns={"area_parqueo_id"}), @ORM\Index(name="IDX_C9FA160315C84B52", columns={"matricula_id"})})
 * @ORM\Entity(repositoryClass="Transporte\TransporteBundle\Entity\VehiculoRepository")
 */
class Vehiculo
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
     * @ORM\Column(name="marca", type="string", length=45, nullable=false)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=45, nullable=false)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=45, nullable=true)
     */
    private $tipo;

    /**
     * @var \Area
     *
     * @ORM\ManyToOne(targetEntity="Otros\NomencladorBundle\Entity\Area")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     * })
     */
    private $area;

    /**
     * @var \AreaParqueo
     *
     * @ORM\ManyToOne(targetEntity="AreaParqueo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="area_parqueo_id", referencedColumnName="id")
     * })
     */
    private $areaParqueo;

    /**
     * @var \Matricula
     *
     * @ORM\OneToOne(targetEntity="Matricula", inversedBy="vehiculo")
     * @ORM\JoinColumn(name="matricula_id", referencedColumnName="id")
     */
    private $matricula;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="SituacionOperativa", inversedBy="vehiculo")
     * @ORM\JoinTable(name="situacion_operativa_vehiculo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="vehiculo_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="situacion_operativa_id", referencedColumnName="id")
     *   }
     * )
     */
    private $situacionOperativa;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->situacionOperativa = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set marca
     *
     * @param string $marca
     * @return Vehiculo
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Vehiculo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Vehiculo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set area
     *
     * @param \Otros\NomencladorBundle\Entity\Area $area
     * @return Vehiculo
     */
    public function setArea(\Otros\NomencladorBundle\Entity\Area $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \Otros\NomencladorBundle\Entity\Area 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set areaParqueo
     *
     * @param \Transporte\TransporteBundle\Entity\AreaParqueo $areaParqueo
     * @return Vehiculo
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
     * Set matricula
     *
     * @param \Transporte\TransporteBundle\Entity\Matricula $matricula
     * @return Vehiculo
     */
    public function setMatricula(\Transporte\TransporteBundle\Entity\Matricula $matricula = null)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get matricula
     *
     * @return \Transporte\TransporteBundle\Entity\Matricula 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Add situacionOperativa
     *
     * @param \Transporte\TransporteBundle\Entity\SituacionOperativa $situacionOperativa
     * @return Vehiculo
     */
    public function addSituacionOperativa(\Transporte\TransporteBundle\Entity\SituacionOperativa $situacionOperativa)
    {
        $this->situacionOperativa[] = $situacionOperativa;

        return $this;
    }

    /**
     * Remove situacionOperativa
     *
     * @param \Transporte\TransporteBundle\Entity\SituacionOperativa $situacionOperativa
     */
    public function removeSituacionOperativa(\Transporte\TransporteBundle\Entity\SituacionOperativa $situacionOperativa)
    {
        $this->situacionOperativa->removeElement($situacionOperativa);
    }

    /**
     * Get situacionOperativa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSituacionOperativa()
    {
        return $this->situacionOperativa;
    }
    
    /**
     * Get tipo, marca y modelo
     *
     * @return string 
     */
    public function getTipoMarcaModelo()
    {
        return $this->tipo .', '. $this->marca .', '. $this->modelo;
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
            // Vehículo
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'tipo' => $this->tipo,
            'area' => $this->area->getNombre(),
            'area_id' => $this->getArea()->getId(),
            'areaParqueo' => $this->getAreaParqueo()->getNombre(),
            'area_parqueo_id' => $this->getAreaParqueo()->getId(),
            // Matricula
            'matriculaId' => $this->getMatricula()->getId(),
            'chapa' => $this->getMatricula()->getChapa()
        );
    }    
}
