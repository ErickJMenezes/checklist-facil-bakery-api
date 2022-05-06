<?php

$header = <<<'EOF'
Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.

(c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
EOF;

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        'vendor',
        '.phpunit.cache',
        'app/bootstrap',
        'app/public',
    ])
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12' => true,
    'strict_param' => true,
    'array_syntax' => ['syntax' => 'short'],
    'header_comment' => ['header' => $header],
])
    ->setFinder($finder);
