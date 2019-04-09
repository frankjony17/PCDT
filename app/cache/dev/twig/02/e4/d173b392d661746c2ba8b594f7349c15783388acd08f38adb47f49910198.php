<?php

/* AdminBundle:Portal:index.html.twig */
class __TwigTemplate_02e4d173b392d661746c2ba8b594f7349c15783388acd08f38adb47f49910198 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

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
        echo "PORTAL-CDT-ETECSA";
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
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/portal/index.css"), "html", null, true);
        echo "\" />
";
    }

    // line 13
    public function block_javascripts($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        // line 15
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/vendor/other/mcrypt/Serpent.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/vendor/other/mcrypt/rijndael.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/vendor/other/mcrypt/mcrypt.js"), "html", null, true);
        echo "\"></script>
    ";
        // line 19
        echo "    <script>
        modulo = \"\";
        entorno = \"";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["entorno"]) ? $context["entorno"] : $this->getContext($context, "entorno")), "html", null, true);
        echo "\";

        Ext.application({
            name: 'CDT',

            appFolder: '/js/app',

            controllers: 'portal.ViewportController',

            launch: function() {
                Ext.create('CDT.view.portal.Viewport');
            }
        });
    </script>
    
    <div id=\"login\" align = \"center\" style=\"padding-top: 75px;\"></div>
";
    }

    public function getTemplateName()
    {
        return "AdminBundle:Portal:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 21,  80 => 19,  76 => 17,  72 => 16,  67 => 15,  65 => 14,  62 => 13,  55 => 10,  52 => 9,  44 => 7,  38 => 5,  32 => 3,  22 => 2,  19 => 1,);
    }
}
