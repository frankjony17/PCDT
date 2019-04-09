<?php

namespace Indicadores\IndicadorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Translation\Tests\String;

/**
 * IndCriterioMedida
 *
 * @ORM\Table(name="ind_criterio_medida", uniqueConstraints={@ORM\UniqueConstraint(name="ind_criterio_medida_descripcion_objetivo_id_key", columns={"descripcion", "objetivo_id"}), @ORM\UniqueConstraint(name="ind_criterio_medida_nombre_objetivo_id_key", columns={"nombre", "objetivo_id"})}, indexes={@ORM\Index(name="IDX_F36001C197F4E608", columns={"objetivo_id"}), @ORM\Index(name="IDX_F36001C1EC3656E", columns={"trabajador_id"})})
 * @ORM\Entity(repositoryClass="Indicadores\IndicadorBundle\Entity\IndCriterioMedidaRepository")
 */
class IndCriterioMedida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ind_criterio_medida_id_seq", allocationSize=1, initialValue=1)
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
     * @var \IndObjetivo
     *
     * @ORM\ManyToOne(targetEntity="IndObjetivo", inversedBy="criterioMedida")
     * @ORM\JoinColumn(name="objetivo_id", referencedColumnName="id")
     */
    private $objetivo;

    /**
     * @var \Trabajador
     *
     * @ORM\ManyToOne(targetEntity="\Otros\NomencladorBundle\Entity\Trabajador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trabajador_id", referencedColumnName="id")
     * })
     */
    private $trabajador;

    /**
     * @var \IndPlan
     *
     * @ORM\OneToOne(targetEntity="IndPlan", mappedBy="criterioMedida")
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
     * Set nombre
     *
     * @param string $nombre
     * @return IndCriterioMedida
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return IndCriterioMedida
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
     * Set objetivo
     *
     * @param \Indicadores\IndicadorBundle\Entity\IndObjetivo $objetivo
     * @return IndCriterioMedida
     */
    public function setObjetivo(\Indicadores\IndicadorBundle\Entity\IndObjetivo $objetivo = null)
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return \Indicadores\IndicadorBundle\Entity\IndObjetivo 
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set trabajador
     *
     * @param \Otros\NomencladorBundle\Entity\Trabajador $trabajador
     * @return IndCriterioMedida
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
     * Get plan
     *
     * @return \Indicadores\IndicadorBundle\Entity\IndPlan
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Get Array Row
     *
     * @return array
     */
    public function toArray()
    {
        $data = $this->getPlanReal();

        return array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'responsable' => $this->getTrabajador()->getNombreApellidos(),
            'plan' => $data["plan"],
            'real' => $data["real"],
            'progress' => $data["progress"],
            'pie' => $data["pie"],
            'estado' => $data["estado"],
            'objetivo' => $this->getObjetivo()->getNombre(),
            'objetivo_descripcion' => $this->getObjetivo()->getNombre() ." => ". $this->getObjetivo()->getDescripcion(),
            'evaluacion' => $data["evaluacion"],
            'tabla_real' => $this->getTabla()
        );
    }

    /**
     * Get Datos, Analisis Criterio de Medida.
     *
     * @return array
     */
    public function getData()
    {
        $real = $this->getReal();
        $plan = is_object($this->getPlan()) ? $this->getPlan()->getValor() : 0;
        $estado = false;

        if ($plan > 0) {
            if($this->getPlan()->getEvaluacion()->getTipo() === "Defecto") {
                $val = ((1 - ($real["total"] / $plan)) + 1) * 100;
                $estado = $val >= 100 ? true : false;
            }
        }
        return array(
            'id' => $this->getId(),
            'ene' => $real["ene"],
            'feb' => $real["feb"],
            'mar' => $real["mar"],
            'abr' => $real["abr"],
            'may' => $real["may"],
            'jun' => $real["jun"],
            'jul' => $real["jul"],
            'ago' => $real["ago"],
            'sep' => $real["sep"],
            'oct' => $real["oct"],
            'nov' => $real["nov"],
            'dic' => $real["dic"],
            'plan' => $plan,
            'real' => $real["total"],
            'cm' => $this->getNombre() .", ". $this->getDescripcion(),
            'responsable' => $this->getTrabajador()->getNombreApellidos(),
            'arc' => $this->getObjetivo()->getArc()->getNombre() .", ". $this->getObjetivo()->getArc()->getDescripcion(),
            'objetivo' => $this->getObjetivo()->getNombre() .", ". $this->getObjetivo()->getDescripcion(),
            'estado' => $estado
        );
    }

    /**
     * Get String HTML TABLE
     *
     * @return String
     */
    private function getTabla ()
    {
        $real = $this->getReal();

        return "<div class='tablestayle-indicador'>
            <table>
              <thead>
                <tr>
                  <th>Ene</th><th>Feb</th><th>Mar</th><th>Abr</th><th>May</th><th>Jun</th>
                  <th>Jul</th><th>Ago</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dic</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>". $real["ene"] ."</td><td>". $real["feb"] ."</td><td>". $real["mar"] ."</th>
                  <td>". $real["abr"] ."</td><td>". $real["may"] ."</td><td>". $real["jun"] ."</th>
                  <td>". $real["jul"] ."</td><td>". $real["ago"] ."</td><td>". $real["sep"] ."</th>
                  <td>". $real["oct"] ."</td><td>". $real["nov"] ."</td><td>". $real["dic"] ."</th>
                  <td>". $real["total"] ."</th>
                </tr>
              </tbody>
            </table>
        </div>";
    }

    /**
     * Get Real por meses.
     *
     * @return array
     */
    private function getReal()
    {
        $meses = array(
            "ene" => 0, "feb" => 0, "mar" => 0, "abr" => 0, "may" => 0, "jun" => 0,
            "jul" => 0, "ago" => 0, "sep" => 0, "oct" => 0, "nov" => 0, "dic" => 0, "total" => 0
        );
        $contador = 0;
        if ($this->getPlan()) {
            if ($this->getPlan()->getReal()) {
                foreach ($this->getPlan()->getReal() as $r) {
                    switch ($r->getMes()) {
                        case "1":
                            $meses["ene"] = $r->getValor();
                            $contador++;
                            break;
                        case "2":
                            $meses["feb"] = $r->getValor();
                            $contador++;
                            break;
                        case "3":
                            $meses["mar"] = $r->getValor();
                            $contador++;
                            break;
                        case "4":
                            $meses["abr"] = $r->getValor();
                            $contador++;
                            break;
                        case "5":
                            $meses["may"] = $r->getValor();
                            $contador++;
                            break;
                        case "6":
                            $meses["jun"] = $r->getValor();
                            $contador++;
                            break;
                        case "7":
                            $meses["jul"] = $r->getValor();
                            $contador++;
                            break;
                        case "8":
                            $meses["ago"] = $r->getValor();
                            $contador++;
                            break;
                        case "9":
                            $meses["sep"] = $r->getValor();
                            $contador++;
                            break;
                        case "10":
                            $meses["oct"] = $r->getValor();
                            $contador++;
                            break;
                        case "11":
                            $meses["nov"] = $r->getValor();
                            $contador++;
                            break;
                        case "12":
                            $meses["dic"] = $r->getValor();
                            $contador++;
                            break;
                    }
                    $meses["total"] += $r->getValor();
                }
            }
        }
        $meses["total"] = ($contador > 0) ? $meses["total"] / $contador : 0;
        return $meses;
    }

    public function getPlanReal ()
    {
        $valor_plan = 0;
        $valor_real = 0;
        $valor_cont = 0;
        $progress = 0;
        $pie = array(0, 0);
        $estado = false;
        $evaluacion = "";
        // Valor del Plan y el Real.
        if ($this->getPlan())
        {
            $valor_plan = $this->getPlan()->getValor();
            foreach ($this->getPlan()->getReal() as $real)
            {
                $valor_real += $real->getValor();
                $valor_cont++;
            }
            $valor_cont > 0 ? $valor_real /= $valor_cont: null;
            // Pie
            $pie = array($valor_plan, $valor_real);
            //Es un % que no es dividido por 100, para obtener un numero entre 0 y 1.
            $progress = $valor_real / $valor_plan;
            // estado
            $estado = $valor_real >= $valor_plan ? true : false;
            // Evaluación, por Exeso o Defecto.
            if($this->getPlan()->getEvaluacion()->getTipo() === "Defecto")
            {
                // Como el # esta ente 0 y 1 al restarle 1 queda la otra parte. Esa parte mas uno representa el sobrecumplimiento.
                $progress = (1 - $progress) + 1;
                $pie = array(100, $progress * 100); // %
                $estado = $pie[1] >= 100 ? true : false;
            }
            $evaluacion = $this->getPlan()->getEvaluacion()->getTipo();
        }
        return array(
            "plan" => $valor_plan,
            "real" => $valor_real,
            "progress" => $progress,
            "pie" => $pie,
            "estado" => $estado,
            "evaluacion" => $evaluacion
        );
    }
}
