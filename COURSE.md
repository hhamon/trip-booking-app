# Auditing the Codebase

## Fixing Composer Dependencies

As a general best practice, relying on `dev` minimum stability in `composer.json` file should be discouraged.

```json
{
    "minimum-stability": "dev",
    "require": {
        "composer/package-versions-deprecated": "1.x-dev",
        "easycorp/easyadmin-bundle": "^2.0@dev",
        "phpdocumentor/reflection-docblock": "5.x-dev",
        "sensio/framework-extra-bundle": "^5.4@dev"
    },
    "require-dev": {
        "doctrine/doctrine-fixtures-bundle": "^3.3@dev",
        "phpunit/phpunit": "10.0.x-dev"
    }
}
```

Application code should always rely on `stable` minimum stability.

```json
{
    "minimum-stability": "stable"
}
```

As a consequence, declared third party dependencies should rely on stable version numbers.

```json
{
    "require": {
        "composer/package-versions-deprecated": "^1.11.99.5",
        "easycorp/easyadmin-bundle": "^2.3.15",
        "phpdocumentor/reflection-docblock": "^5.3.0",
        "sensio/framework-extra-bundle": "^5.6.1"
    },
    "require-dev": {
        "doctrine/doctrine-fixtures-bundle": "^3.4.5",
        "phpunit/phpunit": "^10.5.8"
    }
}
```

Update third party dependencies.

```bash
$ (symfony) composer up
```

Force fixed third party dependencies.

```bash
$ (symfony) composer bump
```

```json
{
    "require": {
        "php": ">=7.1.3",
        "ext-ctype": "*",
        "ext-iconv": "*",
        "composer/package-versions-deprecated": "^1.11.99.5",
        "doctrine/annotations": "^1.14.3",
        "doctrine/doctrine-bundle": "^2.7.2",
        "doctrine/doctrine-migrations-bundle": "^2.2.3",
        "doctrine/orm": "^2.17.3",
        "easycorp/easyadmin-bundle": "^2.3.15",
        "phpdocumentor/reflection-docblock": "^5.3.0",
        "sensio/framework-extra-bundle": "^5.6.1",
        "symfony/apache-pack": "v1.0.1",
        "symfony/asset": "4.4.*",
        "symfony/console": "4.4.*",
        "symfony/dotenv": "4.4.*",
        "symfony/expression-language": "4.4.*",
        "symfony/finder": "4.4.*",
        "symfony/flex": "^1.21.4",
        "symfony/form": "4.4.*",
        "symfony/framework-bundle": "4.4.*",
        "symfony/monolog-bundle": "^3.8",
        "symfony/process": "4.4.*",
        "symfony/property-access": "4.4.*",
        "symfony/property-info": "4.4.*",
        "symfony/security-bundle": "4.4.*",
        "symfony/serializer": "4.4.*",
        "symfony/swiftmailer-bundle": "^3.5.4",
        "symfony/translation": "4.4.*",
        "symfony/twig-bundle": "4.4.*",
        "symfony/validator": "4.4.*",
        "symfony/web-link": "4.4.*",
        "symfony/yaml": "4.4.*"
    },
    "require-dev": {
        "doctrine/doctrine-fixtures-bundle": "^3.4.5",
        "phpunit/phpunit": "^10.5.8",
        "symfony/browser-kit": "4.4.*",
        "symfony/css-selector": "4.4.*",
        "symfony/debug-bundle": "4.4.*",
        "symfony/maker-bundle": "^1.39.1",
        "symfony/phpunit-bridge": "4.4.*",
        "symfony/stopwatch": "4.4.*",
        "symfony/web-profiler-bundle": "4.4.*",
        "symfony/web-server-bundle": "4.4.*"
    }
}
```

## Measuring Code Size

`phploc` is a tool for quickly measuring the size of a PHP project.

```bash
$ cd bin/
$ wget https://phar.phpunit.de/phploc.phar
$ chmod +x phploc.phar
```

```
$ symfony php bin/phploc.phar src/

phploc 7.0.2 by Sebastian Bergmann.

Directories                                         10
Files                                               52

Size
  Lines of Code (LOC)                             3843
  Comment Lines of Code (CLOC)                     392 (10.20%)
  Non-Comment Lines of Code (NCLOC)               3451 (89.80%)
  Logical Lines of Code (LLOC)                     853 (22.20%)
    Classes                                        853 (100.00%)
      Average Class Length                          16
        Minimum Class Length                         1
        Maximum Class Length                        72
      Average Method Length                          3
        Minimum Method Length                        0
        Maximum Method Length                       34
      Average Methods Per Class                      4
        Minimum Methods Per Class                    1
        Maximum Methods Per Class                   34
    Functions                                        0 (0.00%)
      Average Function Length                        0
    Not in classes or functions                      0 (0.00%)

Cyclomatic Complexity
  Average Complexity per LLOC                     0.18
  Average Complexity per Class                    3.94
    Minimum Class Complexity                      1.00
    Maximum Class Complexity                     24.00
  Average Complexity per Method                   1.65
    Minimum Method Complexity                     1.00
    Maximum Method Complexity                    10.00

Dependencies
  Global Accesses                                    0
    Global Constants                                 0 (0.00%)
    Global Variables                                 0 (0.00%)
    Super-Global Variables                           0 (0.00%)
  Attribute Accesses                               155
    Non-Static                                     155 (100.00%)
    Static                                           0 (0.00%)
  Method Calls                                     711
    Non-Static                                     693 (97.47%)
    Static                                          18 (2.53%)

Structure
  Namespaces                                        11
  Interfaces                                         0
  Traits                                             0
  Classes                                           52
    Abstract Classes                                 0 (0.00%)
    Concrete Classes                                52 (100.00%)
      Final Classes                                  2 (3.85%)
      Non-Final Classes                             50 (96.15%)
  Methods                                          223
    Scope
      Non-Static Methods                           221 (99.10%)
      Static Methods                                 2 (0.90%)
    Visibility
      Public Methods                               200 (89.69%)
      Protected Methods                              3 (1.35%)
      Private Methods                               20 (8.97%)
  Functions                                         10
    Named Functions                                  0 (0.00%)
    Anonymous Functions                             10 (100.00%)
  Constants                                         38
    Global Constants                                 0 (0.00%)
    Class Constants                                 38 (100.00%)
      Public Constants                              37 (97.37%)
      Non-Public Constants                           1 (2.63%)

```

## Detecting Code Duplication

`phpcpd` is a Copy/Paste Detector (CPD) for PHP code.

```bash
$ cd bin/
$ wget https://phar.phpunit.de/phpcpd.phar
$ chmod +x phpcpd.phar
```

```
$ symfony php bin/phpcpd.phar src

phpcpd 6.0.3 by Sebastian Bergmann.

Found 2 clones with 68 duplicated lines in 4 files:

  - /Users/hhamon/Code/legacy-trip-booking/src/Form/BookingOfferFiltersType.php:110-146 (36 lines)
    /Users/hhamon/Code/legacy-trip-booking/src/Form/BookingOfferSearchType.php:69-105

  - /Users/hhamon/Code/legacy-trip-booking/src/Form/RegistrationType.php:16-48 (32 lines)
    /Users/hhamon/Code/legacy-trip-booking/src/Form/SettingsType.php:17-49

1.77% duplicated lines out of 3843 total lines of code.
Average size of duplication is 34 lines, largest clone has 36 of lines

Time: 00:00.010, Memory: 4.00 MB
```

## Gathering Metrics Dependencies

`PHP_Depend` is a small program that performs static code analysis on a given source base. It first takes the source
code and parses it into an easily processable internal data structure. Then it measures several values, the so-called
software metrics. Each of these values stands for a quality aspect in the analyzed software.

```bash
$ cd bin/
$ wget https://pdepend.org/static/latest/pdepend.phar
$ chmod +x pdepend.phar
```

```
$ symfony php bin/pdepend.phar \
    --summary-xml=var/tmp/summary.xml \
    --jdepend-chart=var/tmp/jdepend.svg \ 
    --overview-pyramid=var/tmp/pyramid.svg \ 
    src

PDepend 2.16.1snapshot202312101839

Parsing source files:
....................................................            52

Calculating Cyclomatic Complexity metrics:
....................                                           404

Calculating Node Loc metrics:
................                                               338

Calculating NPath Complexity metrics:
....................                                           404

Calculating Inheritance metrics:
...                                                             63

Calculating Node Count metrics:
..............                                                 286

Calculating Hierarchy metrics:
.................                                              352

Calculating Code Rank metrics:
...                                                             63

Calculating Coupling metrics:
....................                                           404

Calculating Class Level metrics:
.................                                              352

Calculating Cohesion metrics:
................................                               641

Calculating Halstead metrics:
....................                                           404

Calculating Maintainability Index metrics:
....................                                           404

Calculating Dependency metrics:
..............                                                 286

Generating pdepend log files, this may take a moment.

Time: 0:00:00; Memory: 18.39Mb
```

* http://igm.univ-mlv.fr/~dr/XPOSE2005/JDepend/presentation.php

## Surfacing Potential Bugs & Suboptimal Code

`phpmd` (PHP Mess Detector) is a spin-off project of `PHP_Depend` and aims to be a PHP equivalent of the well known Java
tool `PMD`. PHPMD can be seen as a user-friendly and easy to configure frontend for the raw metrics measured by
PHP Depend.

What PHPMD does is: It takes a given PHP source code base and look for several potential problems within that source.
These problems can be things like:

- Possible bugs
- Suboptimal code
- Overcomplicated expressions
- Unused parameters, methods, properties

PHPMD is a mature project and provides a diverse set of predefined rules (though may be not as many its Java brother PMD)
to detect code smells and possible errors within the analyzed source code.

```bash
$ cd bin/
$ wget -c https://phpmd.org/static/latest/phpmd.phar
$ chmod +x phpmd.phar
```

```
$ symfony php bin/phpmd.phar src/ text cleancode,codesize,controversial,design,naming,unusedcode

/Users/hhamon/Code/legacy-trip-booking/bin/phpmd.phar/vendor/symfony/config/Resource/FileResource.php on line 21
/Users/hhamon/Code/legacy-trip-booking/src/Controller/CareerController.php:17                 ShortVariable           Avoid variables with short names like $em. Configured minimum length is 3.
/Users/hhamon/Code/legacy-trip-booking/src/Controller/HomeController.php:27                   UndefinedVariable       Avoid using undefined variables such as '$departureSpots' which will lead to PHP notices.
/Users/hhamon/Code/legacy-trip-booking/src/Controller/HomeController.php:35                   UndefinedVariable       Avoid using undefined variables such as '$departureSpots' which will lead to PHP notices.
/Users/hhamon/Code/legacy-trip-booking/src/Controller/NewsletterController.php:20             CamelCaseVariableName   The variable $news_object is not named in camelCase.
/Users/hhamon/Code/legacy-trip-booking/src/Controller/NewsletterController.php:21             CamelCaseVariableName   The variable $news_form is not named in camelCase.
/Users/hhamon/Code/legacy-trip-booking/src/Controller/NewsletterController.php:44             ShortVariable           Avoid variables with short names like $em. Configured minimum length is 3.
/Users/hhamon/Code/legacy-trip-booking/src/Controller/NewsletterController.php:45             LongVariable            Avoid excessively long variable names like $newsletterSubscription. Keep variable name length under 20.
/Users/hhamon/Code/legacy-trip-booking/src/Controller/NewsletterController.php:50             ElseExpression          The method signUp uses an else expression. Else clauses are basically not necessary and you can simplify the code by not using them.
...
```

## Fixing Code Discrepancies

`ECS` (`Easy Coding Standards`) is a standalone tool for fixing your PHP code coding standards violations.
It does both detecting coding styles discrepancies and fixing them.

```bash
$ symfony composer require symplify/easy-coding-standard --dev
```

Configure ECS behavior.

```php
<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withParallel()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withRules([
        ArraySyntaxFixer::class,
    ])
    ->withPhpCsFixerSets(
        php74Migration: true,
        php80Migration: true,
        php81Migration: true,
        php82Migration: true,
        php83Migration: true,
        symfony: true,
        doctrineAnnotation: true,
    )
;
```

Run ECS to fix PHP code.

```bash
$ # Dry-run
$ (symfony) php vendor/bin/ecs

$ # Fix run
$ (symfony) symfony php vendor/bin/ecs --fix 
```

## Analyzing Code Statically

`PHPStan` focuses on finding errors in your code without actually running it. It catches whole classes of bugs even
before you write tests for the code. It moves PHP closer to compiled languages in the sense that the correctness of
each line of the code can be checked before you run the actual line.

```bash
$ symfony composer require phpstan/phpstan --dev
```

Configure PHPStan behavior.

```neon
# phpstan.neon.dist
parameters:
    level: max
    paths:
        - bin/
        - config/
        - public/
        - src/
        - tests/

```

Run ECS to fix PHP code.

```text
$ (symfony) php vendor/bin/phpstan

 56/56 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ -------------------------------------------------------------------------------
  Line   src/Controller/CareerController.php
 ------ -------------------------------------------------------------------------------
  14     Method App\Controller\CareerController::index() has no return type specified.
 ------ -------------------------------------------------------------------------------

 ------ ----------------------------------------------------------------------------------------------------------
  Line   src/Controller/HomeController.php
 ------ ----------------------------------------------------------------------------------------------------------
  34     Variable $departureSpots might not be defined.
  48     Call to an undefined method Doctrine\Persistence\ObjectRepository<App\Entity\BookingOffer>::findOffer().
 ------ ----------------------------------------------------------------------------------------------------------

...
```

Generating a PHPStan baseline file.

```bash
$ (symfony) php vendor/bin/phpstan --generate-baseline
```

```neon
includes:
    - phpstan-baseline.neon
parameters:
    level: max
    paths:
        - bin/
        - config/
        - public/
        - src/
        - tests/
```

```neon
parameters:
	ignoreErrors:
		-
			message: "#^Method App\\\\Controller\\\\CareerController\\:\\:index\\(\\) has no return type specified\\.$#"
			count: 1
			path: src/Controller/CareerController.php

		-
			message: "#^Call to an undefined method Doctrine\\\\Persistence\\\\ObjectRepository\\<App\\\\Entity\\\\BookingOffer\\>\\:\\:findOffer\\(\\)\\.$#"
			count: 1
			path: src/Controller/HomeController.php
#...
```

Adding PHPStan extensions.

```bash
$ (symfony) composer require --dev phpstan/extension-installer
$ (symfony) composer require --dev phpstan/phpstan-deprecation-rules \
  phpstan/phpstan-doctrine \
  phpstan/phpstan-symfony \
  phpstan/phpstan-phpunit
```

Running PHPStan with extra extensions.

```
$ (symfony) php vendor/bin/phpstan

Note: Using configuration file /Users/hhamon/Code/legacy-trip-booking/phpstan.dist.neon.
 56/56 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ ------------------------------------------------------------------------------------------------------------------
  Line   config/bundles.php
 ------ ------------------------------------------------------------------------------------------------------------------
  16     Fetching class constant class of deprecated class Symfony\Bundle\WebServerBundle\WebServerBundle:
         since Symfony 4.4, to be removed in 5.0; the new Symfony local server has more features, you can use it instead.
 ------ ------------------------------------------------------------------------------------------------------------------

 ------ ----------------------------------------------------------------------------
  Line   public/index.php
 ------ ----------------------------------------------------------------------------
  12     Call to method enable() of deprecated class Symfony\Component\Debug\Debug:
         since Symfony 4.4, use Symfony\Component\ErrorHandler\Debug instead.
 ------ ----------------------------------------------------------------------------

...
```

## Adding PHP Forward Compatibility with Polyfills

The Symfony Polyfill project backports features found in the latest PHP versions and provides compatibility layers for
some extensions and functions. It is intended to be used when portability across PHP versions and extensions is desired.
It is strongly recommended to upgrade your PHP version and/or install the missing extensions whenever possible. Polyfill
should be used only when there is no better choice or when portability is a requirement.

See https://github.com/symfony/polyfill

Installing Polyfills for PHP version up to PHP 8.3.

```bash
$ (symfony) composer require symfony/polyfill-php72 \
  symfony/polyfill-php73 \
  symfony/polyfill-php74 \
  symfony/polyfill-php80 \
  symfony/polyfill-php81 \
  symfony/polyfill-php82 \
  symfony/polyfill-php83
```

## Upgrading Code

`Rector` is a PHP tool that you can run on any PHP project to get an instant upgrade or automated refactoring. It helps
with PHP upgrades, framework upgrades and improves your code quality. Also, it helps with type-coverage and getting to
the latest PHPStan level.

```bash
$ (symfony) composer require --dev rector/rector
```

Configure Rector.

```php
<?php

// rector.php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/config',
        __DIR__ . '/public',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_83,
    ]);
};
```

Run Rector.

```bash
$ (symfony) composer require --dev rector/rector
```
