#SimpleSAMLphp Composer Twig module

This package add support for the twig template library through a SimpleSAMLphp module
installable through [Composer](https://getcomposer.org/). Installation can be as
easy as executing:

```
composer.phar require sgomez/simplesamlphp-module-twig ~1.0
```

##Using

This module search in all modules this directory structure: ```modulename/**/Resources/views/``` and create a namespace
for each module that has one.

Render a template is as easy as this:

```php
$engine = \SimpleSAML\Modules\Twig\TwigEngine::getInstance();
echo $engine->render('@modulename/template.html.twig');
```

