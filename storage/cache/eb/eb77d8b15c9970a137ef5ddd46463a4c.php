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

/* auth/register.twig */
class __TwigTemplate_a8b6af4ca3da2de64d0a74e15085a0c8 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $this->loadTemplate("layouts/base.twig", "auth/register.twig", 1)->display($context);
        echo " ";
        $this->displayBlock('body', $context, $blocks);
    }

    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        echo "<main>
\t<form action=\"/auth/register\" method=\"post\" class=\"flex flex-col\">
\t\t<label>
\t\t\t<span>Email</span>
\t\t\t<input type=\"email\" name=\"email\" />
\t\t</label>
\t\t<label>
\t\t\t<span>Password</span>
\t\t\t<input type=\"password\" name=\"password\" />
\t\t</label>
\t\t<label>
\t\t\t<span>Confirm Password</span>
\t\t\t<input type=\"password\" name=\"password_confirmation\" />
\t\t</label>
\t\t<button type=\"submit\">Register</button>
\t</form>
</main>
";
    }

    public function getTemplateName()
    {
        return "auth/register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "auth/register.twig", "/home/m-stam/Public/php/project-s2/resources/views/auth/register.twig");
    }
}
