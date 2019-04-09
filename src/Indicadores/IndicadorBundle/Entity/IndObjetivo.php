<?php

namespace Indicadores\IndicadorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndObjetivo
 *
 * @ORM\Table(name="ind_objetivo", uniqueConstraints={@ORM\UniqueConstraint(name="ind_objetivo_nombre_tipo_objetivo_id_key", columns={"nombre", "tipo_objetivo_id"}), @ORM\UniqueConstraint(name="ind_objetivo_descripcion_tipo_objetivo_id_key", columns={"descripcion", "tipo_objetivo_id"})}, indexes={@ORM\Index(name="IDX_53075962A2D0C8F0", columns={"tipo_objetivo_id"}), @ORM\Index(name="IDX_5307596241EB8A3C", columns={"arc_id"})})
 * @ORM\Entity(repositoryClass="Indicadores\IndicadorBundle\Entity\IndObjetivoRepository")
 */
class IndObjetivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ind_objetivo_id_seq", allocationSize=1, initialValue=1)
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
     * @var \IndTipoObjetivo
     *
     * @ORM\ManyToOne(targetEntity="IndTipoObjetivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_objetivo_id", referencedColumnName="id")
     * })
     */
    private $tipoObjetivo;

    /**
     * @var \IndArc
     *
     * @ORM\ManyToOne(targetEntity="IndArc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="arc_id", referencedColumnName="id")
     * })
     */
    private $arc;

    /**
     * @var \IndCriterioMedida
     *
     * @ORM\OneToMany(targetEntity="IndCriterioMedida", mappedBy="objetivo")
     */
    private $criterioMedida;

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
     * @return IndObjetivo
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
        $objetivo = explode("-", $this->nombre);
        return $objetivo[0];
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return IndObjetivo
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
     * Set tipoObjetivo
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndTipoObjetivo $tipoObjetivo
     * @return IndObjetivo
     */
    public function setTipoObjetivo(\Indicadores\IndicadorBundle\Entity\IndTipoObjetivo $tipoObjetivo = null)
    {
        $this->tipoObjetivo = $tipoObjetivo;

        return $this;
    }

    /**
     * Get tipoObjetivo
     *
     * @return \Indicadores\IndicadorBundle\Entity\IndTipoObjetivo 
     */
    public function getTipoObjetivo()
    {
        return $this->tipoObjetivo;
    }

    /**
     * Set arc
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndArc $arc
     * @return IndObjetivo
     */
    public function setArc(\Indicadores\IndicadorBundle\Entity\IndArc $arc = null)
    {
        $this->arc = $arc;

        return $this;
    }

    /**
     * Get arc
     *
     * @return \Indicadores\IndicadorBundle\Entity\IndArc 
     */
    public function getArc()
    {
        return $this->arc;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->criterioMedida = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add criterioMedida
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndCriterioMedida $criterioMedida
     * @return IndObjetivo
     */
    public function addCriterioMedida(\Indicadores\IndicadorBundle\Entity\IndCriterioMedida $criterioMedida)
    {
        $this->criterioMedida[] = $criterioMedida;

        return $this;
    }

    /**
     * Remove criterioMedida
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndCriterioMedida $criterioMedida
     */
    public function removeCriterioMedida(\Indicadores\IndicadorBundle\Entity\IndCriterioMedida $criterioMedida)
    {
        $this->criterioMedida->removeElement($criterioMedida);
    }

    /**
     * Get criterioMedida
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCriterioMedida()
    {
        return $this->criterioMedida;
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
            'arc' => $this->getArc()->getNombre() ." <=> ". $this->getArc()->getDescripcion(),
            'tipo_objetivo' => $this->getTipoObjetivo()->getNombre()
        );
    }
}
