<?php
/**
 * Classe que gera os relatórios do apcomp
 * @author Augusto Lorencatto
 */

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/r_mapa_cotacao.php';

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

use Reports\Reports;

//! TODO: Colocar uma secret key para validação

$report = new Reports;

$filial = $_GET['filial'];
$cotacao = $_GET['cotacao'];

//* Validação se existe cotação
if(empty($cotacao) || empty($filial)){
    die(json_encode(array('error' => true, 'msg' => "Filial ou cotação não informadas")));
}

try{
    $report->compileMapaCotacao();
    $resultFile = $report->processMapaCotacao($filial,$cotacao);

    // echo $resultFile;

}catch(Exception $e){
    die(json_encode(array('error' => true, 'msg' => $e->getMessage())));
}


die(json_encode(array('error' => false, 'msg' => "Relatório gerado com sucesso", 'filepath' => $resultFile)));