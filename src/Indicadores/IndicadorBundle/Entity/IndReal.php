<?php

namespace Indicadores\IndicadorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndReal
 *
 * @ORM\Table(name="ind_real", uniqueConstraints={@ORM\UniqueConstraint(name="real_mes_plan_id_key", columns={"mes", "plan_id"})}, indexes={@ORM\Index(name="IDX_EFE1505EE899029B", columns={"plan_id"})})
 * @ORM\Entity
 */
class IndReal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ind_real_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="mes", type="integer", nullable=false)
     */
    private $mes;

    /**
     * @var \IndPlan
     *
     * @ORM\ManyToOne(targetEntity="IndPlan", inversedBy="real")
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id")
     */
    private $plan;

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
     * @return IndReal
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
     * Set mes
     *
     * @param integer $mes
     * @return IndReal
     */
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes
     *
     * @return integer 
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set plan
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndPlan $plan
     * @return IndReal
     */
    public function setPlan(\Indicadores\IndicadorBundle\Entity\IndPlan $plan = null)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return \Indicadores\IndicadorBundle\Entity\IndPlan 
     */
    public function getPlan()
    {
        return $this->plan;
    }
}
