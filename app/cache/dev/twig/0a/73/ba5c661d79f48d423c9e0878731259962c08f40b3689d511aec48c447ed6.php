<?php

/* AdminBundle:Admin:globalScript.html.twig */
class __TwigTemplate_0a73ba5c661d79f48d423c9e0878731259962c08f40b3689d511aec48c447ed6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "usuario = \"";
        echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["session"]) ? $context["session"] : $this->getContext($context, "session")), "get", array(0 => "nombre_apellidos_trabajador"), "method"), " "), "html", null, true);
        echo "\";
unidadorganizativa = \"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["session"]) ? $context["session"] : $this->getContext($context, "session")), "get", array(0 => "nombre_unidad_organizativa"), "method"), "html", null, true);
        echo "\";
entorno = \"";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["session"]) ? $context["session"] : $this->getContext($context, "session")), "get", array(0 => "entorno"), "method"), "html", null, true);
        echo "\";
aplicaciones = [];

";
        // line 6
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 7
            echo "    aplicaciones.push({'text': 'Administración', 'iconCls': 'admin-app', 'id': 'admin-app-id'});
";
        }
        // line 9
        echo "
";
        // line 10
        if ($this->env->getExtension('security')->isGranted("ROLE_ESPECIALISTA_TRANSPORTE")) {
            // line 11
            echo "    aplicaciones.push({'text': 'Transporte (Especialista)', 'iconCls': 'transporte-app-especialista', 'id': 'transporte-app-especialista-id'});
";
        }
        // line 13
        if ($this->env->getExtension('security')->isGranted("ROLE_PLANIFICADOR_TRANSPORTE")) {
            // line 14
            echo "    aplicaciones.push({'text': 'Transporte (Planificador)', 'iconCls': 'transporte-app-planificador', 'id': 'transporte-app-planificador-id'});
";
        }
        // line 16
        if ($this->env->getExtension('security')->isGranted("ROLE_TECNICO_TRANSPORTE")) {
            // line 17
            echo "    aplicaciones.push({'text': 'Transporte (Operativo de Guardia)', 'iconCls': 'transporte-app-tecnico', 'id': 'transporte-app-tecnico-id'});
";
        }
        // line 19
        echo "
";
        // line 20
        if ($this->env->getExtension('security')->isGranted("ROLE_ESPECIALISTA_TAREAS_OPERATIVAS")) {
            // line 21
            echo "    aplicaciones.push({'text': 'Tareas Operativas (Especialista)', 'iconCls': 'tareas-operativas-app-especialista', 'id': 'tareas-operativas-app-especialista-id'});
";
        }
        // line 23
        if ($this->env->getExtension('security')->isGranted("ROLE_SUPERVISOR_TAREAS_OPERATIVAS")) {
            // line 24
            echo "    aplicaciones.push({'text': 'Tareas Operativas (Supervisor)', 'iconCls': 'tareas-operativas-app-supervisor', 'id': 'tareas-operativas-app-supervisor-id'});
";
        }
        // line 26
        if ($this->env->getExtension('security')->isGranted("ROLE_TECNICO_TAREAS_OPERATIVAS")) {
            // line 27
            echo "    aplicaciones.push({'text': 'Tareas Operativas (Operativo de Guardia)', 'iconCls': 'transporte-app-tecnico', 'id': 'tareas-operativas-app-tecnico-id'});
";
        }
        // line 29
        if ($this->env->getExtension('security')->isGranted("ROLE_RESPONSABLE_TAREAS_OPERATIVAS")) {
            // line 30
            echo "    aplicaciones.push({'text': 'Tareas Operativas (Responsable)', 'iconCls': 'tareas-operativas-app-responsable', 'id': 'tareas-operativas-app-responsable-id'});
";
        }
    }

    public function getTemplateName()
    {
        return "AdminBundle:Admin:globalScript.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 30,  82 => 29,  78 => 27,  76 => 26,  72 => 24,  70 => 23,  66 => 21,  64 => 20,  61 => 19,  57 => 17,  55 => 16,  51 => 14,  49 => 13,  45 => 11,  43 => 10,  40 => 9,  36 => 7,  34 => 6,  28 => 3,  24 => 2,  19 => 1,  114 => 46,  110 => 44,  105 => 41,  101 => 39,  99 => 38,  94 => 35,  89 => 32,  79 => 24,  77 => 23,  67 => 15,  65 => 14,  60 => 13,  53 => 10,  50 => 9,  44 => 7,  38 => 5,  32 => 3,);
    }
}
