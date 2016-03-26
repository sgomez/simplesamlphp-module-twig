<?php
/*
 * This file is part of the simplesamlphp-module-twig.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimpleSAML\Modules\Twig;


use Symfony\Component\Finder\Finder;

class TwigEngine
{
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $loader = new \Twig_Loader_Filesystem();
        $moduleRoot = \SimpleSAML_Module::getModuleDir(null);

        $finder = new Finder();
        $finder->directories()->in($moduleRoot)->path('/Resources\/views/');

        foreach ($finder as $item) {
            $path = $item->getRelativePathname();
            $module = substr($path, 0, strpos($path, '/'));
            $loader->addPath($moduleRoot.$path, $module);
        }

        self::$instance = new \Twig_Environment($loader);

        return self::$instance;
    }
}