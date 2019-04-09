<?php

/* ::ext-4.2.1.html.twig */
class __TwigTemplate_fed175063f8b871c5b6408634c4f4e53d6ae6d10510640689e474b272a664713 extends Twig_Template
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
        // line 3
        echo "<link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/vendor/ext-4.2.1/ext-theme-neptune/ext-theme-neptune-all.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/all.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />

<script type=\"text/javascript\" src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/vendor/ext-4.2.1/ext-all.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/vendor/ext-4.2.1/ext-lang-es.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/vendor/ext-4.2.1/shared/VTypes.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/vendor/other/util.js"), "html", null, true);
        echo "\"></script>

<script>
    Ext.Loader.setConfig({
        enabled: true
    });
    Ext.Loader.setPath({
        'Ext.ux': '/js/vendor/ext-4.2.1/shared'
    });
</script>";
    }

    public function getTemplateName()
    {
        return "::ext-4.2.1.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 9,  40 => 8,  36 => 7,  32 => 6,  27 => 4,  22 => 3,  19 => 1,);
    }
}
