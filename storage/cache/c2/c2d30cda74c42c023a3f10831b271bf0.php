<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* layouts/head.twig */
class __TwigTemplate_92b97aab82629509273531bbe71d4a42 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        if (twig_get_attribute($this->env, $this->source, ($context["globals"] ?? null), "isDev", [], "any", false, false, false, 1)) {
            // line 2
            echo "<script type=\"module\" src=\"http://localhost:5173/@vite/client\"></script>
<script type=\"module\" src=\"http://localhost:5173/ts/main.ts\"></script>
";
        } else {
            // line 5
            echo "<script type=\"module\" crossorigin src=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["globals"] ?? null), "js", [], "any", false, false, false, 5), "html", null, true);
            echo "\"></script>
";
            // line 6
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["globals"] ?? null), "preloads", [], "any", false, false, false, 6));
            foreach ($context['_seq'] as $context["_key"] => $context["preload"]) {
                // line 7
                echo "<link rel=\"modulepreload\" href=\"";
                echo twig_escape_filter($this->env, $context["preload"], "html", null, true);
                echo "\" />
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['preload'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 8
            echo " ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["globals"] ?? null), "css", [], "any", false, false, false, 8));
            foreach ($context['_seq'] as $context["_key"] => $context["css"]) {
                // line 9
                echo "<link rel=\"stylesheet\" href=\"";
                echo twig_escape_filter($this->env, $context["css"], "html", null, true);
                echo "\" />
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 10
            echo " ";
        }
        echo " ";
        $context["title"] = (($context["title"]) ?? (twig_get_attribute($this->env, $this->source, ($context["globals"] ?? null), "appName", [], "any", false, false, false, 10)));
        // line 11
        echo "<title>";
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</title>
";
    }

    public function getTemplateName()
    {
        return "layouts/head.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 11,  76 => 10,  67 => 9,  62 => 8,  53 => 7,  49 => 6,  44 => 5,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "layouts/head.twig", "/home/m-stam/Public/php/mvc/resources/views/layouts/head.twig");
    }
}
