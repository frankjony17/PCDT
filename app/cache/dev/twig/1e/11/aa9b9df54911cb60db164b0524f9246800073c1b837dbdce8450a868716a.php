<?php

/* CalidadBundle:ControlCalidad:index.html.twig */
class __TwigTemplate_1e11aa9b9df54911cb60db164b0524f9246800073c1b837dbdce8450a868716a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("::base.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'favicon' => array($this, 'block_favicon'),
            'extjs' => array($this, 'block_extjs'),
            'stylesheet' => array($this, 'block_stylesheet'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "CONTROL-CALIDAD";
    }

    // line 5
    public function block_favicon($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
    }

    // line 7
    public function block_extjs($context, array $blocks = array())
    {
        $this->env->loadTemplate("::ext-6.2.0.html.twig")->display($context);
    }

    // line 9
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 10
        echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/control_calidad/icons.css"), "html", null, true);
        echo "\" />
";
    }

    // line 13
    public function block_javascripts($context, array $blocks = array())
    {
        echo "<script>
    ";
        // line 14
        $this->env->loadTemplate("AdminBundle:Admin:globalScript.html.twig")->display($context);
        // line 15
        echo "
    ";
        // line 17
        echo "
    Ext.application({
        name: 'CDT',
        appFolder: '/js/app',

        controllers: [
            ";
        // line 23
        if (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == "especialista")) {
            // line 24
            echo "                \"control_calidad.especialista.ViewportController\",
                \"control_calidad.especialista.ControlCalidadGridController\",
                \"control_calidad.especialista.ControlCalidadFormController\",
                \"control_calidad.especialista.PlanAccionController\",
                \"control_calidad.especialista.ControlTipoController\",
                \"control_calidad.especialista.ControlController\",
            ";
        } elseif (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == "responsable")) {
            // line 31
            echo "                \"control_calidad.especialista.ViewportController\",
                \"control_calidad.especialista.ControlCalidadGridController\",
                \"control_calidad.especialista.ControlCalidadFormController\",
                \"control_calidad.especialista.PlanAccionController\",
            ";
        }
        // line 36
        echo "        ],
        launch : function()
        {
            ";
        // line 39
        if (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == "especialista")) {
            // line 40
            echo "                Ext.create('CDT.view.control_calidad.especialista.Viewport', { appId: 'control-calidad-app-especialista-id' });
            ";
        } elseif (((isset($context["modulo"]) ? $context["modulo"] : $this->getContext($context, "modulo")) == "responsable")) {
            // line 42
            echo "                Ext.create('CDT.view.control_calidad.responsable.Viewport', { appId: 'control-calidad-app-responsable-id' });
            ";
        } else {
            // line 44
            echo "                location.href = entorno+'/secured/logout';
            ";
        }
        // line 46
        echo "        }
    });
</script>";
    }

    public function getTemplateName()
    {
        return "CalidadBundle:ControlCalidad:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 46,  119 => 44,  115 => 42,  111 => 40,  109 => 39,  104 => 36,  97 => 31,  88 => 24,  86 => 23,  78 => 17,  75 => 15,  73 => 14,  68 => 13,  61 => 10,  58 => 9,  52 => 7,  46 => 5,  40 => 3,  11 => 1,);
    }
}
