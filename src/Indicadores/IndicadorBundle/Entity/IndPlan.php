<?php

namespace Indicadores\IndicadorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndPlan
 *
 * @ORM\Table(name="ind_plan", uniqueConstraints={@ORM\UniqueConstraint(name="ind_plan_criterio_medida_id_unidad_organizativa_id_key", columns={"criterio_medida_id", "unidad_organizativa_id"})}, indexes={@ORM\Index(name="IDX_A437C2764DD7DAF5", columns={"criterio_medida_id"}), @ORM\Index(name="IDX_A437C276E715F406", columns={"evaluacion_id"}), @ORM\Index(name="IDX_A437C2767373B779", columns={"unidad_organizativa_id"})})
 * @ORM\Entity
 */
class IndPlan
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ind_plan_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor;

    /**
     * @var \IndCriterioMedida
     *
     * @ORM\OneToOne(targetEntity="IndCriterioMedida", inversedBy="plan")
     * @ORM\JoinColumn(name="criterio_medida_id", referencedColumnName="id")
     */
    private $criterioMedida;

    /**
     * @var \IndEvaluacion
     *
     * @ORM\ManyToOne(targetEntity="IndEvaluacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evaluacion_id", referencedColumnName="id")
     * })
     */
    private $evaluacion;

    /**
     * @var \UnidadOrganizativa
     *
     * @ORM\ManyToOne(targetEntity="\Otros\NomencladorBundle\Entity\UnidadOrganizativa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unidad_organizativa_id", referencedColumnName="id")
     * })
     */
    private $unidadOrganizativa;

    /**
     * @var \IndReal
     *
     * @ORM\OneToMany(targetEntity="IndReal", mappedBy="plan")
     */
    private $real;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->real = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set valor
     *
     * @param float $valor
     * @return IndPlan
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Get evaluacion
     *
     * @return \Indicadores\IndicadorBundle\Entity\IndEvaluacion 
     */
    public function getEvaluacion()
    {
        return $this->evaluacion;
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
     * Get real
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReal()
    {
        return $this->real;
    }

    /**
     * Get criterioMedida
     *
     * @return \Indicadores\IndicadorBundle\Entity\IndCriterioMedida 
     */
    public function getCriterioMedida()
    {
        return $this->criterioMedida;
    }

    /**
     * Add real
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndReal $real
     * @return IndPlan
     */
    public function addReal(\Indicadores\IndicadorBundle\Entity\IndReal $real)
    {
        $this->real[] = $real;

        return $this;
    }

    /**
     * Remove real
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndReal $real
     */
    public function removeReal(\Indicadores\IndicadorBundle\Entity\IndReal $real)
    {
        $this->real->removeElement($real);
    }

    /**
     * Set criterioMedida
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndCriterioMedida $criterioMedida
     * @return IndPlan
     */
    public function setCriterioMedida(\Indicadores\IndicadorBundle\Entity\IndCriterioMedida $criterioMedida = null)
    {
        $this->criterioMedida = $criterioMedida;

        return $this;
    }

    /**
     * Set evaluacion
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndEvaluacion $evaluacion
     * @return IndPlan
     */
    public function setEvaluacion(\Indicadores\IndicadorBundle\Entity\IndEvaluacion $evaluacion = null)
    {
        $this->evaluacion = $evaluacion;

        return $this;
    }

    /**
     * Set unidadOrganizativa
     *
     * @param \Otros\NomencladorBundle\Entity\UnidadOrganizativa $unidadOrganizativa
     * @return IndPlan
     */
    public function setUnidadOrganizativa(\Otros\NomencladorBundle\Entity\UnidadOrganizativa $unidadOrganizativa = null)
    {
        $this->unidadOrganizativa = $unidadOrganizativa;

        return $this;
    }
}
