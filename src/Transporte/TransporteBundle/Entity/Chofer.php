<?php

namespace Transporte\TransporteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chofer
 *
 * @ORM\Table(name="chofer", uniqueConstraints={@ORM\UniqueConstraint(name="chofer_trabajador_id_key", columns={"trabajador_id"}), @ORM\UniqueConstraint(name="chofer_licencia_key", columns={"licencia"})})
 * @ORM\Entity(repositoryClass="Transporte\TransporteBundle\Entity\ChoferRepository")
 */
class Chofer
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
     * @ORM\Column(name="licencia", type="string", length=20, nullable=true)
     */
    private $licencia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="profecional", type="boolean", nullable=true)
     */
    private $profecional;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_parqueo", type="time", nullable=true)
     */
    private $horaParqueo;

    /**
     * @var \Otros\NomencladorBundle\Entity\Trabajador
     *
     * @ORM\OneToOne(targetEntity="\Otros\NomencladorBundle\Entity\Trabajador")
     * @ORM\JoinColumn(name="trabajador_id", referencedColumnName="id")
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
     * Set licencia
     *
     * @param string $licencia
     * @return Chofer
     */
    public function setLicencia($licencia)
    {
        $this->licencia = $licencia;

        return $this;
    }

    /**
     * Get licencia
     *
     * @return string 
     */
    public function getLicencia()
    {
        return $this->licencia;
    }

    /**
     * Set profecional
     *
     * @param boolean $profecional
     * @return Chofer
     */
    public function setProfecional($profecional)
    {
        $this->profecional = $profecional;

        return $this;
    }

    /**
     * Get profecional
     *
     * @return boolean 
     */
    public function getProfecional()
    {
        return $this->profecional;
    }

    /**
     * Set horaParqueo
     *
     * @param \DateTime $horaParqueo
     * @return Chofer
     */
    public function setHoraParqueo($horaParqueo)
    {
        $this->horaParqueo = $horaParqueo;

        return $this;
    }

    /**
     * Get horaParqueo
     *
     * @return \DateTime 
     */
    public function getHoraParqueo()
    {
        return $this->horaParqueo;
    }

    /**
     * Set trabajador
     *
     * @param \Otros\NomencladorBundle\Entity\Trabajador $trabajador
     * @return Chofer
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
            'licencia' => $this->licencia,
            'profecional' => ($this->profecional) ? 'SI' : 'NO',
            'horaParqueo' => $this->horaParqueo->format('H:i:i'),
            // Trabajador
            'area' => $this->getTrabajador()->getArea()->getNombre(),
            'trabajador' => $this->getTrabajador()->getNombreApellidos(),
            'trabajador_id' => $this->getTrabajador()->getId()
        );
    }
}
