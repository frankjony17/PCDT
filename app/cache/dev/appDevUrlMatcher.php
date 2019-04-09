<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/controlcalidad')) {
            if (0 === strpos($pathinfo, '/controlcalidad/c')) {
                if (0 === strpos($pathinfo, '/controlcalidad/cc')) {
                    // calidad_calidad_controlcalidad_list
                    if ($pathinfo === '/controlcalidad/cc/list') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'calidad_calidad_controlcalidad_list', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlCalidadController::listAction',  '_route' => 'calidad_calidad_controlcalidad_list',);
                    }

                    // calidad_calidad_controlcalidad_add
                    if ($pathinfo === '/controlcalidad/cc/add') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'calidad_calidad_controlcalidad_add', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlCalidadController::addAction',  '_route' => 'calidad_calidad_controlcalidad_add',);
                    }

                    if (0 === strpos($pathinfo, '/controlcalidad/cc/e')) {
                        // calidad_calidad_controlcalidad_edit
                        if ($pathinfo === '/controlcalidad/cc/edit') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'calidad_calidad_controlcalidad_edit', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlCalidadController::editAction',  '_route' => 'calidad_calidad_controlcalidad_edit',);
                        }

                        // calidad_calidad_controlcalidad_estado
                        if ($pathinfo === '/controlcalidad/cc/estado') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'calidad_calidad_controlcalidad_estado', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlCalidadController::estadoAction',  '_route' => 'calidad_calidad_controlcalidad_estado',);
                        }

                    }

                    // calidad_calidad_controlcalidad_remove
                    if ($pathinfo === '/controlcalidad/cc/remove') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'calidad_calidad_controlcalidad_remove', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlCalidadController::removeAction',  '_route' => 'calidad_calidad_controlcalidad_remove',);
                    }

                }

                if (0 === strpos($pathinfo, '/controlcalidad/control')) {
                    // calidad_calidad_control_list
                    if ($pathinfo === '/controlcalidad/control/list') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'calidad_calidad_control_list', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlController::listAction',  '_route' => 'calidad_calidad_control_list',);
                    }

                    // calidad_calidad_control_add
                    if ($pathinfo === '/controlcalidad/control/add') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'calidad_calidad_control_add', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlController::addAction',  '_route' => 'calidad_calidad_control_add',);
                    }

                    // calidad_calidad_control_edit
                    if ($pathinfo === '/controlcalidad/control/edit') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'calidad_calidad_control_edit', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlController::editAction',  '_route' => 'calidad_calidad_control_edit',);
                    }

                    // calidad_calidad_control_remove
                    if ($pathinfo === '/controlcalidad/control/remove') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'calidad_calidad_control_remove', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlController::removeAction',  '_route' => 'calidad_calidad_control_remove',);
                    }

                    if (0 === strpos($pathinfo, '/controlcalidad/control/tipo')) {
                        // calidad_calidad_controltipo_list
                        if ($pathinfo === '/controlcalidad/control/tipo/list') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'calidad_calidad_controltipo_list', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlTipoController::listAction',  '_route' => 'calidad_calidad_controltipo_list',);
                        }

                        // calidad_calidad_controltipo_add
                        if ($pathinfo === '/controlcalidad/control/tipo/add') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'calidad_calidad_controltipo_add', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlTipoController::addAction',  '_route' => 'calidad_calidad_controltipo_add',);
                        }

                        // calidad_calidad_controltipo_edit
                        if ($pathinfo === '/controlcalidad/control/tipo/edit') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'calidad_calidad_controltipo_edit', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlTipoController::editAction',  '_route' => 'calidad_calidad_controltipo_edit',);
                        }

                        // calidad_calidad_controltipo_remove
                        if ($pathinfo === '/controlcalidad/control/tipo/remove') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'calidad_calidad_controltipo_remove', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\ControlTipoController::removeAction',  '_route' => 'calidad_calidad_controltipo_remove',);
                        }

                    }

                }

            }

            // calidad_calidad_default_indexapp
            if (preg_match('#^/controlcalidad/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'calidad_calidad_default_indexapp', key($requiredSchemes));
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'calidad_calidad_default_indexapp')), array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\DefaultController::indexAppAction',));
            }

            // controlcalidad
            if (rtrim($pathinfo, '/') === '/controlcalidad') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'controlcalidad');
                }

                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'controlcalidad', key($requiredSchemes));
                }

                return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\DefaultController::indexAction',  '_route' => 'controlcalidad',);
            }

            if (0 === strpos($pathinfo, '/controlcalidad/planaccion')) {
                // calidad_calidad_planaccion_list
                if ($pathinfo === '/controlcalidad/planaccion/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'calidad_calidad_planaccion_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\PlanAccionController::listAction',  '_route' => 'calidad_calidad_planaccion_list',);
                }

                // calidad_calidad_planaccion_add
                if ($pathinfo === '/controlcalidad/planaccion/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'calidad_calidad_planaccion_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\PlanAccionController::addAction',  '_route' => 'calidad_calidad_planaccion_add',);
                }

                if (0 === strpos($pathinfo, '/controlcalidad/planaccion/e')) {
                    // calidad_calidad_planaccion_edit
                    if ($pathinfo === '/controlcalidad/planaccion/edit') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'calidad_calidad_planaccion_edit', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\PlanAccionController::editAction',  '_route' => 'calidad_calidad_planaccion_edit',);
                    }

                    // calidad_calidad_planaccion_estado
                    if ($pathinfo === '/controlcalidad/planaccion/estado') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'calidad_calidad_planaccion_estado', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\PlanAccionController::estadoAction',  '_route' => 'calidad_calidad_planaccion_estado',);
                    }

                }

                // calidad_calidad_planaccion_remove
                if ($pathinfo === '/controlcalidad/planaccion/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'calidad_calidad_planaccion_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Calidad\\CalidadBundle\\Controller\\PlanAccionController::removeAction',  '_route' => 'calidad_calidad_planaccion_remove',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/indicadores')) {
            if (0 === strpos($pathinfo, '/indicadores/arc')) {
                // indicadores_indicador_arc_list
                if ($pathinfo === '/indicadores/arc/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_arc_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\ArcController::listAction',  '_route' => 'indicadores_indicador_arc_list',);
                }

                // indicadores_indicador_arc_add
                if ($pathinfo === '/indicadores/arc/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_arc_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\ArcController::addAction',  '_route' => 'indicadores_indicador_arc_add',);
                }

                // indicadores_indicador_arc_edit
                if ($pathinfo === '/indicadores/arc/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_arc_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\ArcController::editAction',  '_route' => 'indicadores_indicador_arc_edit',);
                }

                // indicadores_indicador_arc_remove
                if ($pathinfo === '/indicadores/arc/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_arc_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\ArcController::removeAction',  '_route' => 'indicadores_indicador_arc_remove',);
                }

            }

            if (0 === strpos($pathinfo, '/indicadores/cm')) {
                // indicadores_indicador_criteriomedida_listtree
                if ($pathinfo === '/indicadores/cm/tree/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_criteriomedida_listtree', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\CriterioMedidaController::listTreeAction',  '_route' => 'indicadores_indicador_criteriomedida_listtree',);
                }

                // indicadores_indicador_criteriomedida_list
                if ($pathinfo === '/indicadores/cm/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_criteriomedida_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\CriterioMedidaController::listAction',  '_route' => 'indicadores_indicador_criteriomedida_list',);
                }

                // indicadores_indicador_criteriomedida_add
                if ($pathinfo === '/indicadores/cm/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_criteriomedida_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\CriterioMedidaController::addAction',  '_route' => 'indicadores_indicador_criteriomedida_add',);
                }

                // indicadores_indicador_criteriomedida_edit
                if ($pathinfo === '/indicadores/cm/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_criteriomedida_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\CriterioMedidaController::editAction',  '_route' => 'indicadores_indicador_criteriomedida_edit',);
                }

                if (0 === strpos($pathinfo, '/indicadores/cm/re')) {
                    // indicadores_indicador_criteriomedida_remove
                    if ($pathinfo === '/indicadores/cm/remove') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'indicadores_indicador_criteriomedida_remove', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\CriterioMedidaController::removeAction',  '_route' => 'indicadores_indicador_criteriomedida_remove',);
                    }

                    if (0 === strpos($pathinfo, '/indicadores/cm/real')) {
                        // indicadores_indicador_criteriomedida_listreal
                        if ($pathinfo === '/indicadores/cm/real/list') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'indicadores_indicador_criteriomedida_listreal', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\CriterioMedidaController::listRealAction',  '_route' => 'indicadores_indicador_criteriomedida_listreal',);
                        }

                        // indicadores_indicador_criteriomedida_listrealchart
                        if ($pathinfo === '/indicadores/cm/real/chart/list') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'indicadores_indicador_criteriomedida_listrealchart', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\CriterioMedidaController::listRealChartAction',  '_route' => 'indicadores_indicador_criteriomedida_listrealchart',);
                        }

                    }

                }

            }

            if (0 === strpos($pathinfo, '/indicadores/evaluacion')) {
                // indicadores_indicador_evaluacion_list
                if ($pathinfo === '/indicadores/evaluacion/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_evaluacion_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\EvaluacionController::listAction',  '_route' => 'indicadores_indicador_evaluacion_list',);
                }

                // indicadores_indicador_evaluacion_add
                if ($pathinfo === '/indicadores/evaluacion/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_evaluacion_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\EvaluacionController::addAction',  '_route' => 'indicadores_indicador_evaluacion_add',);
                }

                // indicadores_indicador_evaluacion_edit
                if ($pathinfo === '/indicadores/evaluacion/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_evaluacion_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\EvaluacionController::editAction',  '_route' => 'indicadores_indicador_evaluacion_edit',);
                }

                // indicadores_indicador_evaluacion_remove
                if ($pathinfo === '/indicadores/evaluacion/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_evaluacion_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\EvaluacionController::removeAction',  '_route' => 'indicadores_indicador_evaluacion_remove',);
                }

            }

            // indicadores_indicador_indexindicador_indexapp
            if (preg_match('#^/indicadores/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'indicadores_indicador_indexindicador_indexapp', key($requiredSchemes));
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'indicadores_indicador_indexindicador_indexapp')), array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\IndexIndicadorController::indexAppAction',));
            }

            // indicadores
            if (rtrim($pathinfo, '/') === '/indicadores') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'indicadores');
                }

                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'indicadores', key($requiredSchemes));
                }

                return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\IndexIndicadorController::indexAction',  '_route' => 'indicadores',);
            }

            if (0 === strpos($pathinfo, '/indicadores/objetivo')) {
                // indicadores_indicador_objetivo_list
                if ($pathinfo === '/indicadores/objetivo/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_objetivo_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\ObjetivoController::listAction',  '_route' => 'indicadores_indicador_objetivo_list',);
                }

                // indicadores_indicador_objetivo_add
                if ($pathinfo === '/indicadores/objetivo/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_objetivo_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\ObjetivoController::addAction',  '_route' => 'indicadores_indicador_objetivo_add',);
                }

                // indicadores_indicador_objetivo_edit
                if ($pathinfo === '/indicadores/objetivo/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_objetivo_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\ObjetivoController::editAction',  '_route' => 'indicadores_indicador_objetivo_edit',);
                }

                // indicadores_indicador_objetivo_remove
                if ($pathinfo === '/indicadores/objetivo/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'indicadores_indicador_objetivo_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\ObjetivoController::removeAction',  '_route' => 'indicadores_indicador_objetivo_remove',);
                }

                if (0 === strpos($pathinfo, '/indicadores/objetivo/tipo')) {
                    // indicadores_indicador_tipoobjetivo_list
                    if ($pathinfo === '/indicadores/objetivo/tipo/list') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'indicadores_indicador_tipoobjetivo_list', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\TipoObjetivoController::listAction',  '_route' => 'indicadores_indicador_tipoobjetivo_list',);
                    }

                    // indicadores_indicador_tipoobjetivo_add
                    if ($pathinfo === '/indicadores/objetivo/tipo/add') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'indicadores_indicador_tipoobjetivo_add', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\TipoObjetivoController::addAction',  '_route' => 'indicadores_indicador_tipoobjetivo_add',);
                    }

                    // indicadores_indicador_tipoobjetivo_edit
                    if ($pathinfo === '/indicadores/objetivo/tipo/edit') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'indicadores_indicador_tipoobjetivo_edit', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\TipoObjetivoController::editAction',  '_route' => 'indicadores_indicador_tipoobjetivo_edit',);
                    }

                    // indicadores_indicador_tipoobjetivo_remove
                    if ($pathinfo === '/indicadores/objetivo/tipo/remove') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'indicadores_indicador_tipoobjetivo_remove', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Indicadores\\IndicadorBundle\\Controller\\TipoObjetivoController::removeAction',  '_route' => 'indicadores_indicador_tipoobjetivo_remove',);
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/tareasoperativas')) {
            if (0 === strpos($pathinfo, '/tareasoperativas/accion')) {
                // otros_tareaoperativa_acciontareaoperativa_list
                if ($pathinfo === '/tareasoperativas/accion/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_tareaoperativa_acciontareaoperativa_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\AccionTareaOperativaController::listAction',  '_route' => 'otros_tareaoperativa_acciontareaoperativa_list',);
                }

                // otros_tareaoperativa_acciontareaoperativa_getdescripcion
                if ($pathinfo === '/tareasoperativas/accion/get_descripcion') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_tareaoperativa_acciontareaoperativa_getdescripcion', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\AccionTareaOperativaController::getDescripcionAction',  '_route' => 'otros_tareaoperativa_acciontareaoperativa_getdescripcion',);
                }

                // otros_tareaoperativa_acciontareaoperativa_add
                if ($pathinfo === '/tareasoperativas/accion/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_tareaoperativa_acciontareaoperativa_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\AccionTareaOperativaController::addAction',  '_route' => 'otros_tareaoperativa_acciontareaoperativa_add',);
                }

                // otros_tareaoperativa_acciontareaoperativa_edit
                if ($pathinfo === '/tareasoperativas/accion/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_tareaoperativa_acciontareaoperativa_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\AccionTareaOperativaController::editAction',  '_route' => 'otros_tareaoperativa_acciontareaoperativa_edit',);
                }

                // otros_tareaoperativa_acciontareaoperativa_remove
                if ($pathinfo === '/tareasoperativas/accion/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_tareaoperativa_acciontareaoperativa_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\AccionTareaOperativaController::removeAction',  '_route' => 'otros_tareaoperativa_acciontareaoperativa_remove',);
                }

            }

            if (0 === strpos($pathinfo, '/tareasoperativas/to/chart')) {
                if (0 === strpos($pathinfo, '/tareasoperativas/to/chart/especialista')) {
                    // otros_tareaoperativa_chart_listesppiechart
                    if ($pathinfo === '/tareasoperativas/to/chart/especialista/pie/list') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_tareaoperativa_chart_listesppiechart', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\ChartController::listEspPieChartAction',  '_route' => 'otros_tareaoperativa_chart_listesppiechart',);
                    }

                    // otros_tareaoperativa_chart_listbarchart
                    if ($pathinfo === '/tareasoperativas/to/chart/especialista/bar/list') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_tareaoperativa_chart_listbarchart', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\ChartController::listBarChartAction',  '_route' => 'otros_tareaoperativa_chart_listbarchart',);
                    }

                }

                if (0 === strpos($pathinfo, '/tareasoperativas/to/chart/responsable')) {
                    // otros_tareaoperativa_chart_listrespiechart
                    if ($pathinfo === '/tareasoperativas/to/chart/responsable/pie/list') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_tareaoperativa_chart_listrespiechart', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\ChartController::listResPieChartAction',  '_route' => 'otros_tareaoperativa_chart_listrespiechart',);
                    }

                    // otros_tareaoperativa_chart_listresbarchart
                    if ($pathinfo === '/tareasoperativas/to/chart/responsable/bar/list') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_tareaoperativa_chart_listresbarchart', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\ChartController::listResBarChartAction',  '_route' => 'otros_tareaoperativa_chart_listresbarchart',);
                    }

                }

            }

            // otros_tareaoperativa_chequeotarea_periodochequeo
            if ($pathinfo === '/tareasoperativas/chequeo/edit') {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'otros_tareaoperativa_chequeotarea_periodochequeo', key($requiredSchemes));
                }

                return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\ChequeoTareaController::periodoChequeoAction',  '_route' => 'otros_tareaoperativa_chequeotarea_periodochequeo',);
            }

            if (0 === strpos($pathinfo, '/tareasoperativas/e')) {
                if (0 === strpos($pathinfo, '/tareasoperativas/email')) {
                    // otros_tareaoperativa_email_responsables
                    if ($pathinfo === '/tareasoperativas/email/responsables/send') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_tareaoperativa_email_responsables', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\EmailController::responsablesAction',  '_route' => 'otros_tareaoperativa_email_responsables',);
                    }

                    // otros_tareaoperativa_email_otros
                    if ($pathinfo === '/tareasoperativas/email/otros/send') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_tareaoperativa_email_otros', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\EmailController::otrosAction',  '_route' => 'otros_tareaoperativa_email_otros',);
                    }

                }

                if (0 === strpos($pathinfo, '/tareasoperativas/estado/add_')) {
                    // otros_tareaoperativa_estadotarea_fechafinaledit
                    if ($pathinfo === '/tareasoperativas/estado/add_fecha_final_estado') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_tareaoperativa_estadotarea_fechafinaledit', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\EstadoTareaController::fechaFinalEditAction',  '_route' => 'otros_tareaoperativa_estadotarea_fechafinaledit',);
                    }

                    // otros_tareaoperativa_estadotarea_estadoedit
                    if ($pathinfo === '/tareasoperativas/estado/add_estado_final') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_tareaoperativa_estadotarea_estadoedit', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\EstadoTareaController::estadoEditAction',  '_route' => 'otros_tareaoperativa_estadotarea_estadoedit',);
                    }

                }

            }

            // otros_tareaoperativa_indextareaoperativa_indexapp
            if (preg_match('#^/tareasoperativas/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'otros_tareaoperativa_indextareaoperativa_indexapp', key($requiredSchemes));
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'otros_tareaoperativa_indextareaoperativa_indexapp')), array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\IndexTareaOperativaController::indexAppAction',));
            }

            // tareasoperativas
            if (rtrim($pathinfo, '/') === '/tareasoperativas') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'tareasoperativas');
                }

                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'tareasoperativas', key($requiredSchemes));
                }

                return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\IndexTareaOperativaController::indexAction',  '_route' => 'tareasoperativas',);
            }

            // otros_tareaoperativa_responsable_add
            if ($pathinfo === '/tareasoperativas/responsable/add') {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'otros_tareaoperativa_responsable_add', key($requiredSchemes));
                }

                return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\ResponsableController::addAction',  '_route' => 'otros_tareaoperativa_responsable_add',);
            }

            if (0 === strpos($pathinfo, '/tareasoperativas/to')) {
                // otros_tareaoperativa_tareaoperativa_list
                if ($pathinfo === '/tareasoperativas/to/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_tareaoperativa_tareaoperativa_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\TareaOperativaController::listAction',  '_route' => 'otros_tareaoperativa_tareaoperativa_list',);
                }

                // otros_tareaoperativa_tareaoperativa_add
                if ($pathinfo === '/tareasoperativas/to/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_tareaoperativa_tareaoperativa_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\TareaOperativaController::addAction',  '_route' => 'otros_tareaoperativa_tareaoperativa_add',);
                }

                // otros_tareaoperativa_tareaoperativa_edit
                if ($pathinfo === '/tareasoperativas/to/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_tareaoperativa_tareaoperativa_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\TareaOperativaController::editAction',  '_route' => 'otros_tareaoperativa_tareaoperativa_edit',);
                }

                // otros_tareaoperativa_tareaoperativa_remove
                if ($pathinfo === '/tareasoperativas/to/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_tareaoperativa_tareaoperativa_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\TareaOperativaBundle\\Controller\\TareaOperativaController::removeAction',  '_route' => 'otros_tareaoperativa_tareaoperativa_remove',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/all/nomenclador')) {
            if (0 === strpos($pathinfo, '/all/nomenclador/area')) {
                // otros_nomenclador_area_list
                if ($pathinfo === '/all/nomenclador/area/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_area_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\AreaController::listAction',  '_route' => 'otros_nomenclador_area_list',);
                }

                // otros_nomenclador_area_add
                if ($pathinfo === '/all/nomenclador/area/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_area_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\AreaController::addAction',  '_route' => 'otros_nomenclador_area_add',);
                }

                // otros_nomenclador_area_edit
                if ($pathinfo === '/all/nomenclador/area/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_area_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\AreaController::editAction',  '_route' => 'otros_nomenclador_area_edit',);
                }

                // otros_nomenclador_area_remove
                if ($pathinfo === '/all/nomenclador/area/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_area_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\AreaController::removeAction',  '_route' => 'otros_nomenclador_area_remove',);
                }

            }

            if (0 === strpos($pathinfo, '/all/nomenclador/cargo')) {
                // otros_nomenclador_cargo_list
                if ($pathinfo === '/all/nomenclador/cargo/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_cargo_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\CargoController::listAction',  '_route' => 'otros_nomenclador_cargo_list',);
                }

                // otros_nomenclador_cargo_add
                if ($pathinfo === '/all/nomenclador/cargo/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_cargo_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\CargoController::addAction',  '_route' => 'otros_nomenclador_cargo_add',);
                }

                // otros_nomenclador_cargo_edit
                if ($pathinfo === '/all/nomenclador/cargo/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_cargo_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\CargoController::editAction',  '_route' => 'otros_nomenclador_cargo_edit',);
                }

                // otros_nomenclador_cargo_remove
                if ($pathinfo === '/all/nomenclador/cargo/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_cargo_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\CargoController::removeAction',  '_route' => 'otros_nomenclador_cargo_remove',);
                }

            }

            if (0 === strpos($pathinfo, '/all/nomenclador/departamento')) {
                if (0 === strpos($pathinfo, '/all/nomenclador/departamento/list')) {
                    // otros_nomenclador_departamento_list
                    if ($pathinfo === '/all/nomenclador/departamento/list') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_nomenclador_departamento_list', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\DepartamentoController::listAction',  '_route' => 'otros_nomenclador_departamento_list',);
                    }

                    // otros_nomenclador_departamento_listdistinctnombre
                    if ($pathinfo === '/all/nomenclador/departamento/list_distinct_nombre') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'otros_nomenclador_departamento_listdistinctnombre', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\DepartamentoController::listDistinctNombreAction',  '_route' => 'otros_nomenclador_departamento_listdistinctnombre',);
                    }

                }

                // otros_nomenclador_departamento_edit
                if ($pathinfo === '/all/nomenclador/departamento/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_departamento_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\DepartamentoController::editAction',  '_route' => 'otros_nomenclador_departamento_edit',);
                }

                // otros_nomenclador_departamento_remove
                if ($pathinfo === '/all/nomenclador/departamento/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_departamento_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\DepartamentoController::removeAction',  '_route' => 'otros_nomenclador_departamento_remove',);
                }

            }

            // otros_nomenclador_sap_readtxtsaprh
            if ($pathinfo === '/all/nomenclador/sap/read_txt_sap_rh') {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'otros_nomenclador_sap_readtxtsaprh', key($requiredSchemes));
                }

                return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\SAPController::readTxtSapRHAction',  '_route' => 'otros_nomenclador_sap_readtxtsaprh',);
            }

            if (0 === strpos($pathinfo, '/all/nomenclador/trabajador')) {
                // otros_nomenclador_trabajador_listexterno
                if ($pathinfo === '/all/nomenclador/trabajador/externo') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_trabajador_listexterno', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\TrabajadorController::listExternoAction',  '_route' => 'otros_nomenclador_trabajador_listexterno',);
                }

                // otros_nomenclador_trabajador_listinterno
                if ($pathinfo === '/all/nomenclador/trabajador/interno') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_trabajador_listinterno', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\TrabajadorController::listInternoAction',  '_route' => 'otros_nomenclador_trabajador_listinterno',);
                }

                // otros_nomenclador_trabajador_listtrabajadoruser
                if ($pathinfo === '/all/nomenclador/trabajador/list_for_tarea_operativa') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_trabajador_listtrabajadoruser', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\TrabajadorController::listTrabajadorUserAction',  '_route' => 'otros_nomenclador_trabajador_listtrabajadoruser',);
                }

                // otros_nomenclador_trabajador_addareatrabajador
                if ($pathinfo === '/all/nomenclador/trabajador/add_area_trabajador') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_trabajador_addareatrabajador', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\TrabajadorController::addAreaTrabajadorAction',  '_route' => 'otros_nomenclador_trabajador_addareatrabajador',);
                }

                // otros_nomenclador_trabajador_edit
                if ($pathinfo === '/all/nomenclador/trabajador/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_trabajador_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\TrabajadorController::editAction',  '_route' => 'otros_nomenclador_trabajador_edit',);
                }

                // otros_nomenclador_trabajador_addcargotrabajador
                if ($pathinfo === '/all/nomenclador/trabajador/add_cargo_trabajador') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_trabajador_addcargotrabajador', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\TrabajadorController::addCargoTrabajadorAction',  '_route' => 'otros_nomenclador_trabajador_addcargotrabajador',);
                }

                // otros_nomenclador_trabajador_removeareatrabajador
                if ($pathinfo === '/all/nomenclador/trabajador/remove_area_trabajador') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_trabajador_removeareatrabajador', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\TrabajadorController::removeAreaTrabajadorAction',  '_route' => 'otros_nomenclador_trabajador_removeareatrabajador',);
                }

            }

            if (0 === strpos($pathinfo, '/all/nomenclador/uo')) {
                // otros_nomenclador_unidadorganizativa_list
                if ($pathinfo === '/all/nomenclador/uo/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_unidadorganizativa_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\UnidadOrganizativaController::listAction',  '_route' => 'otros_nomenclador_unidadorganizativa_list',);
                }

                // otros_nomenclador_unidadorganizativa_edit
                if ($pathinfo === '/all/nomenclador/uo/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'otros_nomenclador_unidadorganizativa_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Otros\\NomencladorBundle\\Controller\\UnidadOrganizativaController::editAction',  '_route' => 'otros_nomenclador_unidadorganizativa_edit',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/transporte')) {
            // transporte_planificacion_default_index
            if (0 === strpos($pathinfo, '/transporte/planificacion/hello') && preg_match('#^/transporte/planificacion/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'transporte_planificacion_default_index', key($requiredSchemes));
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'transporte_planificacion_default_index')), array (  '_controller' => 'Transporte\\PlanificacionBundle\\Controller\\DefaultController::indexAction',));
            }

            // transporte_circulacioneventual_default_index
            if (0 === strpos($pathinfo, '/transporte/circulacion/eventual/hello') && preg_match('#^/transporte/circulacion/eventual/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'transporte_circulacioneventual_default_index', key($requiredSchemes));
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'transporte_circulacioneventual_default_index')), array (  '_controller' => 'Transporte\\CirculacionEventualBundle\\Controller\\DefaultController::indexAction',));
            }

            // transporte_parqueoeventual_default_index
            if (0 === strpos($pathinfo, '/transporte/parqueo/eventual/hello') && preg_match('#^/transporte/parqueo/eventual/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'transporte_parqueoeventual_default_index', key($requiredSchemes));
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'transporte_parqueoeventual_default_index')), array (  '_controller' => 'Transporte\\ParqueoEventualBundle\\Controller\\DefaultController::indexAction',));
            }

            // transporte_controlparqueo_default_index
            if (0 === strpos($pathinfo, '/transporte/control/parqueo/hello') && preg_match('#^/transporte/control/parqueo/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'transporte_controlparqueo_default_index', key($requiredSchemes));
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'transporte_controlparqueo_default_index')), array (  '_controller' => 'Transporte\\ControlParqueoBundle\\Controller\\DefaultController::indexAction',));
            }

            if (0 === strpos($pathinfo, '/transporte/area_parqueo')) {
                // transporte_transporte_areaparqueo_list
                if ($pathinfo === '/transporte/area_parqueo/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'transporte_transporte_areaparqueo_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\AreaParqueoController::listAction',  '_route' => 'transporte_transporte_areaparqueo_list',);
                }

                // transporte_transporte_areaparqueo_add
                if ($pathinfo === '/transporte/area_parqueo/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'transporte_transporte_areaparqueo_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\AreaParqueoController::addAction',  '_route' => 'transporte_transporte_areaparqueo_add',);
                }

                // transporte_transporte_areaparqueo_edit
                if ($pathinfo === '/transporte/area_parqueo/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'transporte_transporte_areaparqueo_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\AreaParqueoController::editAction',  '_route' => 'transporte_transporte_areaparqueo_edit',);
                }

                // transporte_transporte_areaparqueo_remove
                if ($pathinfo === '/transporte/area_parqueo/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'transporte_transporte_areaparqueo_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\AreaParqueoController::removeAction',  '_route' => 'transporte_transporte_areaparqueo_remove',);
                }

            }

            // transporte_transporte_chofer_list
            if ($pathinfo === '/transporte/chofer/list') {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'transporte_transporte_chofer_list', key($requiredSchemes));
                }

                return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\ChoferController::listAction',  '_route' => 'transporte_transporte_chofer_list',);
            }

            if (0 === strpos($pathinfo, '/transporte/matricula')) {
                // transporte_transporte_matricula_list
                if ($pathinfo === '/transporte/matricula/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'transporte_transporte_matricula_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\MatriculaController::listAction',  '_route' => 'transporte_transporte_matricula_list',);
                }

                if (0 === strpos($pathinfo, '/transporte/matricula/edit')) {
                    // transporte_transporte_matricula_edit
                    if ($pathinfo === '/transporte/matricula/edit') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'transporte_transporte_matricula_edit', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\MatriculaController::editAction',  '_route' => 'transporte_transporte_matricula_edit',);
                    }

                    // transporte_transporte_matricula_editid
                    if ($pathinfo === '/transporte/matricula/edit_id') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'transporte_transporte_matricula_editid', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\MatriculaController::editIdAction',  '_route' => 'transporte_transporte_matricula_editid',);
                    }

                }

            }

            // transporte_transporte_situacionoperativa_list
            if ($pathinfo === '/transporte/situacion_operativa/list') {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'transporte_transporte_situacionoperativa_list', key($requiredSchemes));
                }

                return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\SituacionOperativaController::listAction',  '_route' => 'transporte_transporte_situacionoperativa_list',);
            }

            // transporte_transporte_transporte_indexapp
            if (preg_match('#^/transporte/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'transporte_transporte_transporte_indexapp', key($requiredSchemes));
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'transporte_transporte_transporte_indexapp')), array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\TransporteController::indexAppAction',));
            }

            // transporte
            if (rtrim($pathinfo, '/') === '/transporte') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'transporte');
                }

                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'transporte', key($requiredSchemes));
                }

                return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\TransporteController::indexAction',  '_route' => 'transporte',);
            }

            if (0 === strpos($pathinfo, '/transporte/vehiculo')) {
                // transporte_transporte_vehiculo_list
                if ($pathinfo === '/transporte/vehiculo/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'transporte_transporte_vehiculo_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\VehiculoController::listAction',  '_route' => 'transporte_transporte_vehiculo_list',);
                }

                // transporte_transporte_vehiculo_add
                if ($pathinfo === '/transporte/vehiculo/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'transporte_transporte_vehiculo_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\VehiculoController::addAction',  '_route' => 'transporte_transporte_vehiculo_add',);
                }

                // transporte_transporte_vehiculo_edit
                if ($pathinfo === '/transporte/vehiculo/edit') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'transporte_transporte_vehiculo_edit', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Transporte\\TransporteBundle\\Controller\\VehiculoController::editAction',  '_route' => 'transporte_transporte_vehiculo_edit',);
                }

            }

        }

        // reportes_pdf_transporte_planificacion_planificacion
        if ($pathinfo === '/pdf/transporte/planificacion') {
            $requiredSchemes = array (  'http' => 0,);
            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                return $this->redirect($pathinfo, 'reportes_pdf_transporte_planificacion_planificacion', key($requiredSchemes));
            }

            return array (  '_controller' => 'Reportes\\PDFBundle\\Controller\\transporte\\PlanificacionController::planificacionAction',  '_route' => 'reportes_pdf_transporte_planificacion_planificacion',);
        }

        if (0 === strpos($pathinfo, '/util')) {
            // util_curl_chartexport_chartexport
            if ($pathinfo === '/util/chart/export') {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'util_curl_chartexport_chartexport', key($requiredSchemes));
                }

                return array (  '_controller' => 'Util\\cURLBundle\\Controller\\ChartExportController::chartExportAction',  '_route' => 'util_curl_chartexport_chartexport',);
            }

            if (0 === strpos($pathinfo, '/util/email')) {
                // util_curl_email_list
                if ($pathinfo === '/util/email/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'util_curl_email_list', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Util\\cURLBundle\\Controller\\EmailController::listAction',  '_route' => 'util_curl_email_list',);
                }

                // util_curl_email_add
                if ($pathinfo === '/util/email/add') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'util_curl_email_add', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Util\\cURLBundle\\Controller\\EmailController::addAction',  '_route' => 'util_curl_email_add',);
                }

                // util_curl_email_remove
                if ($pathinfo === '/util/email/remove') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'util_curl_email_remove', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Util\\cURLBundle\\Controller\\EmailController::removeAction',  '_route' => 'util_curl_email_remove',);
                }

                // util_curl_email_adduser
                if ($pathinfo === '/util/email/add_user') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'util_curl_email_adduser', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Util\\cURLBundle\\Controller\\EmailController::addUserAction',  '_route' => 'util_curl_email_adduser',);
                }

                // util_curl_email_recordatoriotareasoperativas
                if ($pathinfo === '/util/email/recordatorio') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'util_curl_email_recordatoriotareasoperativas', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Util\\cURLBundle\\Controller\\EmailController::recordatorioTareasOperativasAction',  '_route' => 'util_curl_email_recordatoriotareasoperativas',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            // admin
            if (rtrim($pathinfo, '/') === '/admin') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin');
                }

                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'admin', key($requiredSchemes));
                }

                return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::indexAction',  '_route' => 'admin',);
            }

            if (0 === strpos($pathinfo, '/admin/roles/list')) {
                // seguridad_admin_admin_listrole
                if ($pathinfo === '/admin/roles/list') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'seguridad_admin_admin_listrole', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::listRoleAction',  '_route' => 'seguridad_admin_admin_listrole',);
                }

                // seguridad_admin_admin_listroleusers
                if ($pathinfo === '/admin/roles/list_roles_users') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'seguridad_admin_admin_listroleusers', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::listRoleUsersAction',  '_route' => 'seguridad_admin_admin_listroleusers',);
                }

            }

            if (0 === strpos($pathinfo, '/admin/users')) {
                if (0 === strpos($pathinfo, '/admin/users/l')) {
                    if (0 === strpos($pathinfo, '/admin/users/list')) {
                        // seguridad_admin_admin_listusers
                        if ($pathinfo === '/admin/users/list') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'seguridad_admin_admin_listusers', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::listUsersAction',  '_route' => 'seguridad_admin_admin_listusers',);
                        }

                        // seguridad_admin_admin_listusersdb
                        if ($pathinfo === '/admin/users/list_user_db') {
                            $requiredSchemes = array (  'http' => 0,);
                            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                                return $this->redirect($pathinfo, 'seguridad_admin_admin_listusersdb', key($requiredSchemes));
                            }

                            return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::listUsersDBAction',  '_route' => 'seguridad_admin_admin_listusersdb',);
                        }

                    }

                    // seguridad_admin_admin_loadnewusers
                    if ($pathinfo === '/admin/users/load_new_users') {
                        $requiredSchemes = array (  'http' => 0,);
                        if (!isset($requiredSchemes[$this->context->getScheme()])) {
                            return $this->redirect($pathinfo, 'seguridad_admin_admin_loadnewusers', key($requiredSchemes));
                        }

                        return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::loadNewUsersAction',  '_route' => 'seguridad_admin_admin_loadnewusers',);
                    }

                }

                // seguridad_admin_admin_removeusers
                if ($pathinfo === '/admin/users/remove_users') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'seguridad_admin_admin_removeusers', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::removeUsersAction',  '_route' => 'seguridad_admin_admin_removeusers',);
                }

                // seguridad_admin_admin_activeusers
                if ($pathinfo === '/admin/users/active_users') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'seguridad_admin_admin_activeusers', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::activeUsersAction',  '_route' => 'seguridad_admin_admin_activeusers',);
                }

                // seguridad_admin_admin_editusers
                if ($pathinfo === '/admin/users/edit_users') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'seguridad_admin_admin_editusers', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::editUsersAction',  '_route' => 'seguridad_admin_admin_editusers',);
                }

                // seguridad_admin_admin_addrolesusers
                if ($pathinfo === '/admin/users/add_roles_users') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'seguridad_admin_admin_addrolesusers', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\AdminController::addRolesUsersAction',  '_route' => 'seguridad_admin_admin_addrolesusers',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/secured/log')) {
            if (0 === strpos($pathinfo, '/secured/login')) {
                // login
                if ($pathinfo === '/secured/login') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'login', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\SecuredController::loginAction',  '_route' => 'login',);
                }

                // security_check
                if ($pathinfo === '/secured/login/check') {
                    $requiredSchemes = array (  'http' => 0,);
                    if (!isset($requiredSchemes[$this->context->getScheme()])) {
                        return $this->redirect($pathinfo, 'security_check', key($requiredSchemes));
                    }

                    return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\SecuredController::securityCheckAction',  '_route' => 'security_check',);
                }

            }

            // logout
            if ($pathinfo === '/secured/logout') {
                $requiredSchemes = array (  'http' => 0,);
                if (!isset($requiredSchemes[$this->context->getScheme()])) {
                    return $this->redirect($pathinfo, 'logout', key($requiredSchemes));
                }

                return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\SecuredController::logoutAction',  '_route' => 'logout',);
            }

        }

        // portal
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'portal');
            }

            $requiredSchemes = array (  'http' => 0,);
            if (!isset($requiredSchemes[$this->context->getScheme()])) {
                return $this->redirect($pathinfo, 'portal', key($requiredSchemes));
            }

            return array (  '_controller' => 'Seguridad\\AdminBundle\\Controller\\PortalController::indexAction',  '_route' => 'portal',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
