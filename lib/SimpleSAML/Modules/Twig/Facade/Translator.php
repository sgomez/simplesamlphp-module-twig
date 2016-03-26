<?php
/*
 * This file is part of the simplesamlphp-module-twig.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimpleSAML\Modules\Twig\Facade;


use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Translator as BaseTranslator;

class Translator
{
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $config = \SimpleSAML_Configuration::getConfig();
        $defaultLocale = $config->getString('language.default', 'en');

        self::$instance = new BaseTranslator($defaultLocale, new MessageSelector());
        self::$instance->addLoader('yaml', new YamlFileLoader());
        self::$instance->setFallbackLocales([$defaultLocale]);

        return self::$instance;
    }
}