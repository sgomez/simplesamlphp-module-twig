<?php
/*
 * This file is part of the simplesamlphp-module-twig.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimpleSAML\Modules\Twig\Extension;


use SimpleSAML\Modules\Twig\Facade\Translator;

class I18n extends \Twig_Extension
{
    private $translator;

    public function __construct()
    {
        $this->translator = Translator::getInstance();
    }

    /**
     * Returns the token parser instances to add to the existing list.
     *
     * @return array An array of Twig_TokenParserInterface or Twig_TokenParserBrokerInterface instances
     */
    public function getTokenParsers()
    {
        return array(new \Twig_Extensions_TokenParser_Trans());
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('trans', [$this, 'trans']),
            new \Twig_SimpleFilter('transChoice', [$this, 'transChoice']),
        ];
    }

    public function trans($id, array $parameters = array(), $domain = null, $locale = null)
    {
        return $this->translator->trans($id, $parameters, $domain, $locale);
    }

    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null)
    {
        return $this->transChoice($id, $number, $parameters, $domain, $locale);
    }

    public function getName()
    {
        return 'simplesaml_module_twig_i18n';
    }
}