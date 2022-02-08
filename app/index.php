<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Examples.php';

use PHPJasper\PHPJasper;
use Examples\Examples;

$examples = new Examples;

// //Compile jrxml into .jasper
$examples->compileExample();

// Processando o hello world
$examples->processExample();

//Generate reports from a JSON file
$examples->JsonExample();

echo "Hello";