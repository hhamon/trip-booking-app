<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\AttributeNotation\AttributeEmptyParenthesesFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer;
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
        AttributeEmptyParenthesesFixer::class,
        FullyQualifiedStrictTypesFixer::class,
        GlobalNamespaceImportFixer::class,
    ])
    ->withPhpCsFixerSets(
        doctrineAnnotation: true,
        php74Migration: true,
        php80Migration: true,
        php81Migration: true,
        php82Migration: true,
        php83Migration: true,
        psr12: true,
        phpCsFixer: true,
        symfony: true,
    )
;