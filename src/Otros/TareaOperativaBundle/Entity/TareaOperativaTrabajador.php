<?php

namespace Otros\TareaOperativaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareaOperativaTrabajador
 *
 * @ORM\Table(name="tarea_operativa_trabajador", uniqueConstraints={@ORM\UniqueConstraint(name="tarea_operativa_trabajador_trabajador_id_tarea_operativa_id_key", columns={"trabajador_id", "tarea_operativa_id"})}, indexes={@ORM\Index(name="IDX_CC4FB6044D25E70E", columns={"tarea_operativa_id"}), @ORM\Index(name="IDX_CC4FB604EC3656E", columns={"trabajador_id"})})
 * @ORM\Entity
 */
class TareaOperativaTrabajador
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
     * @ORM\Column(name="pendiente", type="boolean", nullable=false)
     */
    private $pendiente;

    /**
     * @var \TareaOperativa
     *
     * @ORM\ManyToOne(targetEntity="TareaOperativa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tarea_operativa_id", referencedColumnName="id")
     * })
     */
    private $tareaOperativa;

    /**
     * @var \Otros\NomencladorBundle\Entity\Trabajador
     *
     * @ORM\ManyToOne(targetEntity="\Otros\NomencladorBundle\Entity\Trabajador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trabajador_id", referencedColumnName="id")
     * })
     */
    private $trabajador;

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
     * Set pendiente
     *
     * @param boolean $pendiente
     * @return TareaOperativaTrabajador
     */
    public function setPendiente($pendiente)
    {
        $this->pendiente = $pendiente;

        return $this;
    }

    /**
     * Get pendiente
     *
     * @return boolean 
     */
    public function getPendiente()
    {
        return $this->pendiente;
    }

    /**
     * Set tareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\TareaOperativa $tareaOperativa
     * @return TareaOperativaTrabajador
     */
    public function setTareaOperativa(\Otros\TareaOperativaBundle\Entity\TareaOperativa $tareaOperativa = null)
    {
        $this->tareaOperativa = $tareaOperativa;

        return $this;
    }

    /**
     * Get tareaOperativa
     *
     * @return \Otros\TareaOperativaBundle\Entity\TareaOperativa 
     */
    public function getTareaOperativa()
    {
        return $this->tareaOperativa;
    }

    /**
     * Set trabajador
     *
     * @param \Otros\NomencladorBundle\Entity\Trabajador $trabajador
     * @return TareaOperativaTrabajador
     */
    public function setTrabajador(\Otros\NomencladorBundle\Entity\Trabajador $trabajador = null)
    {
        $this->trabajador = $trabajador;

        return $this;
    }

    /**
     * Get trabajador
     *
     * @return \Otros\NomencladorBundle\Entity\Trabajador
     */
    public function getTrabajador()
    {
        return $this->trabajador;
    }
}
