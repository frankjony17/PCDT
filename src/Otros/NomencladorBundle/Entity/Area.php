<?php

namespace Otros\NomencladorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="area", uniqueConstraints={@ORM\UniqueConstraint(name="area_nombre_unidad_organizativa_id_key", columns={"nombre", "unidad_organizativa_id"})}, indexes={@ORM\Index(name="IDX_D7943D687373B779", columns={"unidad_organizativa_id"})})
 * @ORM\Entity
 */
class Area
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
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var \UnidadOrganizativa
     *
     * @ORM\ManyToOne(targetEntity="UnidadOrganizativa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unidad_organizativa_id", referencedColumnName="id")
     * })
     */
    private $unidadOrganizativa;

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
     * @return Area
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
     * Set unidadOrganizativa
     *
     * @param \Otros\NomencladorBundle\Entity\UnidadOrganizativa $unidadOrganizativa
     * @return Area
     */
    public function setUnidadOrganizativa(\Otros\NomencladorBundle\Entity\UnidadOrganizativa $unidadOrganizativa = null)
    {
        $this->unidadOrganizativa = $unidadOrganizativa;

        return $this;
    }

    /**
     * Get unidadOrganizativa
     *
     * @return \Otros\NomencladorBundle\Entity\UnidadOrganizativa 
     */
    public function getUnidadOrganizativa()
    {
        return $this->unidadOrganizativa;
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
            'unidadOrganizativa' => $this->getUnidadOrganizativa()->getNombre()
        );
    }
}
