<?php
/**
 * Classe que gera os relatórios do apcomp
 * @author Augusto Lorencatto
 */

namespace Reports;

use PHPJasper\PHPJasper;

class Reports
{

    private $PHPJasper;

    public function __construct()
    {
        $this->PHPJasper = new PHPJasper();
    }

    public function compileMapaCotacao()
    {
        //* Só mudar os arquivos, quando tiver o oficial
        // $input_file = __DIR__ . '/input/hello_world.jrxml';
        // $input_file = __DIR__ . '/input/cotacao_baroneza_v1.jrxml';
        $input_file = __DIR__ . '/input/mapa_cotacao_v1.jrxml';
        $output_file = __DIR__ . '/compiled';

        $this->PHPJasper->compile($input_file, $output_file)->execute();
    }
    /**
     * Função que realiza o processamento do arquivo de mapa de cotação
     * @author Augusto Lorencatto
     * @param String $cotacao
     */
    public function processMapaCotacao(string $filial,string $cotacao) : string
    {
        $serverHost =  getenv("JASPER_SERVER_URL"); 

        //* Só mudar os arquivos, quando tiver o oficial
        // $input = __DIR__ . '/compiled/hello_world.jasper';
        $input = __DIR__ . '/compiled/mapa_cotacao_v1.jasper';
        // $output = __DIR__ . '/output/mapa_cotacao/mapa_cotacao_' . $cotacao . '.pdf';
        $output = __DIR__ . '/output/mapa_cotacao/mapa_cotacao.pdf';

        $options = [
            'format' => ['pdf'],
            'params' => [
                'filial'=>$filial,
                'cotacao'=>$cotacao,
            ],
            'locale' => 'pt',
             'db_connection' => [
                'driver'   => "postgres",
                'host'     => "dba.ti9.com.br",
                'port'     => "63183",
                'database' => "weleda_20211008",
                'username' => "postgres",
                'password' => "dtcinfpostgresql",
            ]
        ];

        // $outputPath = "$serverHost/src/output/mapa_cotacao/mapa_cotacao_$cotacao.pdf.pdf";
        $outputPath = "$serverHost/src/output/mapa_cotacao/mapa_cotacao.pdf.pdf";

        $this->PHPJasper->process(
            $input,
            $output,
            $options
        )->execute();

        return $outputPath;

        // $x = $this->PHPJasper->process(
        //     $input,
        //     $output,
        //     $options
        // )->output();
        
        // return $x;
    
    }

}
