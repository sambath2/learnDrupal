<?php

/* modules/ubercart/payment/uc_payment/templates/uc-payment-totals.html.twig */
class __TwigTemplate_cc3e583a19fbe3e767198155443178b7ca2bce01b8edc31e5176f771a0e0135c extends Twig_Template
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
        $tags = array("for" => 18);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('for'),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 17
        echo "<table class=\"uc-payment-totals\">
  ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["line_items"]) ? $context["line_items"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["line"]) {
            // line 19
            echo "    <tr class=\"line-item-";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["line"], "type", array()), "html", null, true));
            echo "\">
      <td class=\"title\">";
            // line 20
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["line"], "title", array()), "html", null, true));
            echo ":</td>
      <td class=\"price\">";
            // line 21
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["line"], "amount", array()), "html", null, true));
            echo "</td>
    </tr>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['line'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "modules/ubercart/payment/uc_payment/templates/uc-payment-totals.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 24,  59 => 21,  55 => 20,  50 => 19,  46 => 18,  43 => 17,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Default theme implementation to display a summary of line items.
 *
 * Available variables:
 * - order: The order that is being displayed.
 * - line_items: An associative array of line items containing:
 *   - type: Line item type.
 *   - title: Line item title.
 *   - amount: Line item price.
 *
 * @see template_preprocess_uc_payment_totals()
 *
 * @ingroup themeable
#}
<table class=\"uc-payment-totals\">
  {% for line in line_items %}
    <tr class=\"line-item-{{ line.type }}\">
      <td class=\"title\">{{ line.title }}:</td>
      <td class=\"price\">{{ line.amount }}</td>
    </tr>
  {% endfor %}
</table>
";
    }
}
