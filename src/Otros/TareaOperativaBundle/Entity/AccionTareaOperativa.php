<?php

namespace Otros\TareaOperativaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\False;

/**
 * AccionTareaOperativa
 *
 * @ORM\Table(name="accion_tarea_operativa", uniqueConstraints={@ORM\UniqueConstraint(name="accion_tarea_operativa_descripcion_tarea_operativa_id_fecha_key", columns={"descripcion", "tarea_operativa_id", "fecha"})}, indexes={@ORM\Index(name="IDX_6F9AC9164D25E70E", columns={"tarea_operativa_id"})})
 * @ORM\Entity(repositoryClass="Otros\TareaOperativaBundle\Entity\AccionTareaOperativaRepository")
 */
class AccionTareaOperativa
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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return AccionTareaOperativa
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return AccionTareaOperativa
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
     * Set tareaOperativa
     *
     * @param \Otros\TareaOperativaBundle\Entity\TareaOperativa $tareaOperativa
     * @return AccionTareaOperativa
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
     * Get array!!!
     *
     * @param bool $bool Falso si no se quieren las etiquetas html en: tarea, descripcion y areaResponsable
     * @return array
     */
    public function toArray($bool=TRUE)
    {
        $responsables = $this->getTareaOperativa()->getAreaResponsableAndTrabajadorId(); $tarea = ""; $estado = "";

        if ($bool === FALSE)
        {
            $stado =  $this->getTareaOperativa()->getLastEstadoTareaOperativa();
            $tarea = $this->getTareaOperativa()->getNumeroTarea() ." <=> ". $this->getString() ."... <=> ". $this->getTareaOperativa()->getFechaCreacion()->format("Y-m-d") ." - ". $stado[0]->format("Y-m-d");

            $stado[1] === "Pendiente" ? $tarea = "<div id='acciones-header'>".$tarea."</div>" : null;
            $estado = $stado[1];
        }
        return array
        (
            'id' => $this->id,
            'fecha' => $this->getFecha()->format("Y-m-d H:i:s"),
            'descripcion' => $this->getDescripcion(),
            'areaResponsable' => $bool===TRUE ? $responsables[0] : strip_tags($responsables[0]),
            'tarea' => $tarea,
            'estado' => $estado
        );
    }

    private function getString()
    {
        $str = strip_tags($this->getTareaOperativa()->getDescripcion());

        return strtoupper(mb_substr($str, 0, 75));
    }
}
