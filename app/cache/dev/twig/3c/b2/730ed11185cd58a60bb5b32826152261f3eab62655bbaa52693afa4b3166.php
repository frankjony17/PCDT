<?php

/* AdminBundle:Secured:login.html.twig */
class __TwigTemplate_3cb2730ed11185cd58a60bb5b32826152261f3eab62655bbaa52693afa4b3166 extends Twig_Template
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
        echo "
";
        // line 2
        $this->env->loadTemplate("AdminBundle:Portal:index.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "AdminBundle:Secured:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 2,  19 => 1,);
    }
}
