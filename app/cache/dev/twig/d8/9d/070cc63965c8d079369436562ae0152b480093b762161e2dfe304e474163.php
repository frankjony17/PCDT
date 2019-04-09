<?php

/* ::base.html.twig */
class __TwigTemplate_d89d070cc63965c8d079369436562ae0152b480093b762161e2dfe304e474163 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'favicon' => array($this, 'block_favicon'),
            'title' => array($this, 'block_title'),
            'extjs' => array($this, 'block_extjs'),
            'stylesheet' => array($this, 'block_stylesheet'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <link rel=\"shortcut icon\" href=\"";
        // line 5
        $this->displayBlock('favicon', $context, $blocks);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/symfony/body.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/symfony/structure.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/symfony/configurator.css"), "html", null, true);
        echo "\" />

        <title>";
        // line 10
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

        ";
        // line 12
        $this->displayBlock('extjs', $context, $blocks);
        // line 13
        echo "
        ";
        // line 14
        $this->displayBlock('stylesheet', $context, $blocks);
        // line 15
        echo "        
        ";
        // line 16
        $this->displayBlock('javascripts', $context, $blocks);
        // line 17
        echo "    </head>
</html>";
    }

    // line 5
    public function block_favicon($context, array $blocks = array())
    {
    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
    }

    // line 12
    public function block_extjs($context, array $blocks = array())
    {
    }

    // line 14
    public function block_stylesheet($context, array $blocks = array())
    {
    }

    // line 16
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 16,  79 => 12,  74 => 10,  69 => 5,  64 => 17,  59 => 15,  57 => 14,  54 => 13,  47 => 10,  42 => 8,  34 => 6,  30 => 5,  24 => 1,  84 => 14,  80 => 19,  76 => 17,  72 => 16,  67 => 15,  65 => 14,  62 => 16,  55 => 10,  52 => 12,  44 => 7,  38 => 7,  32 => 3,  22 => 2,  19 => 1,);
    }
}
