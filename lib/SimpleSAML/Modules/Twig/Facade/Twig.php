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


use SimpleSAML\Modules\Twig\Extension\I18n;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Twig
{
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $loader = new \Twig_Loader_Filesystem();
        $translator = Translator::getInstance();

        $modules = \SimpleSAML_Module::getModules();
        foreach ($modules as $module) {
            if (\SimpleSAML_Module::isModuleEnabled($module)) {
                $path = \SimpleSAML_Module::getModuleDir($module);

                $templatePath = self::resourceExists('templates', $path);
                if (false !== $templatePath) {
                    $loader->addPath($templatePath, $module);
                }

                $translationPath = self::resourceExists('translations', $path);
                if (false !== $translationPath) {
                    $translations = new Finder();
                    $translations->files()->in($translationPath)->name('/\.[a-zA-Z_]+\.yml$/');

                    /** @var SplFileInfo $translation */
                    foreach ($translations as $translation) {
                        $name = $translation->getBasename('.yml');
                        $locale = substr($name, strrpos($name, '.') +1);

                        $translator->addResource('yaml', $translation->getPathname(), $locale, $module);
                    }
                }
            }
        }

        self::$instance = new \Twig_Environment($loader);
        self::$instance->addExtension(new I18n());

        return self::$instance;
    }

    private static function resourceExists($name, $path)
    {
        $resourcePath = sprintf('%s/resources/%s', $path, $name);

        return is_dir($resourcePath) ? $resourcePath : false;
    }
}