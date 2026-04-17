<?php

/**
 *  Configuração do PHP-CS-Fixer para o projeto.
 *
 *  Arquivo settins.json:
 *
 *  "php-cs-fixer.executablePath": "php-cs-fixer",
 *  "php-cs-fixer.config": ".php-cs-fixer.php",
 *  "php-cs-fixer.onsave": true,
 *  "editor.formatOnSave": true,
 *  "[php]": {
 *      "editor.defaultFormatter": "junstyle.php-cs-fixer"
 *  }
 *
 *  Extensão: PHP CS Fixer - Junstyle (VS Code Marketplace)
 *
 *  @author Leandro Marques Ferreira
 */





$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        'ordered_imports' => true,
    ])
    ->setFinder($finder);
