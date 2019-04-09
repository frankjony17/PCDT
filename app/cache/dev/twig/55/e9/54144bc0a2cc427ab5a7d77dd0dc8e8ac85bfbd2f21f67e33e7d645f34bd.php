<?php

/* AdminBundle:Admin:index.html.twig */
class __TwigTemplate_55e954144bc0a2cc427ab5a7d77dd0dc8e8ac85bfbd2f21f67e33e7d645f34bd extends Twig_Template
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
        echo "ADMIN-CDT-ETECSA";
    }

    // line 5
    public function block_favicon($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
    }

    // line 7
    public function block_extjs($context, array $blocks = array())
    {
        echo " ";
        $this->env->loadTemplate("::ext-4.2.1.html.twig")->display($context);
        echo " ";
    }

    // line 9
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 10
        echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/admin/index.css"), "html", null, true);
        echo "\" />
";
    }

    // line 13
    public function block_javascripts($context, array $blocks = array())
    {
        // line 14
        echo "<script>
";
        // line 15
        $this->env->loadTemplate("AdminBundle:Admin:globalScript.html.twig")->display($context);
        // line 16
        echo "    
    Ext.application({
        name: 'CDT',

        appFolder: '/js/app',

        controllers: [
            \"admin.ViewportController\",
            'admin.SeguridadTreeController',
            'admin.OtrosTreeController',
            'admin.AdminController',
            \"email.EmailGridController\",
            'nomenclador.NomencladorTreeController',
            'nomenclador.UnidadOrganizativaController',
            'nomenclador.AreaController',
            'nomenclador.DepartamentoController',
            'nomenclador.CargoController',
            'nomenclador.TrabajadorInternoController',
            'nomenclador.TrabajadorExternoController'
        ],

        launch: function()
        { 
            Ext.create('CDT.view.admin.Viewport');
        }    
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "AdminBundle:Admin:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 16,  76 => 15,  73 => 14,  70 => 13,  63 => 10,  60 => 9,  52 => 7,  46 => 5,  40 => 3,  11 => 1,);
    }
}
