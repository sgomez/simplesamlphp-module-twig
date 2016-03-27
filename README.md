#SimpleSAMLphp Composer Twig module

This package add support for the twig template library through a SimpleSAMLphp module
installable through [Composer](https://getcomposer.org/). Installation can be as
easy as executing:

```
composer.phar require sgomez/simplesamlphp-module-twig ~1.0
```

##Using templates

This module search in all active modules this directory structure: ```modulename/resources/templates/``` and create a namespace
for each module that has one.

Render a template is as easy as this:

```php
$engine = \SimpleSAML\Modules\Twig\TwigEngine::getInstance();
echo $engine->render('@modulename/template.html.twig');
```

##Using translations

This module uses the [symfony/translation](https://symfony.com/doc/current/components/translation/index.html) library
to search translations files in yml format on the next directory: ```modulename/resources/translations/```.

The filename must have the next format: _modulename.locale.yml_

##Twig and translations

This bundle uses the Symfony Twig Extension on [twig-bridge](https://github.com/symfony/twig-bridge) library. So
 basically you can use [the same filters and blocks than Symfony](http://symfony.com/doc/current/book/translation.html).