<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . "/src")
;
$config = new PhpCsFixer\Config();
$config->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'array_indentation' => true,
]);
if (empty($_SERVER['VSCODE_PID'])) { //fix for vscode. Can't format html in php files when using finder
    $config->setFinder($finder);
}
$config->setUsingCache(true);
$config->setCacheFile(sys_get_temp_dir() . "/php-cs-" . md5(__DIR__) . ".cache");

return $config;
