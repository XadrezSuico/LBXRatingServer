<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RatingsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Importacao;
use App\Rating;
use GuzzleHttp\Client;

class CronController extends Controller
{
    private $links = array(
        0 => "http://www.ligabrasileiradexadrez.com.br/Rating_Standard_LBX.xlsx",
        1 => "http://www.ligabrasileiradexadrez.com.br/Rating_Rapido_LBX.xlsx",
        2 => "http://www.ligabrasileiradexadrez.com.br/Rating_Blitz_LBX.xlsx",
    );
    public function downloadRating($tipo_modalidade){
        $importacao = new Importacao;
        $importacao->tipo_modalidade = $tipo_modalidade;
        $importacao->e_automatico = true;
        $importacao->save();

        $ratings_import = new RatingsImport;
        $ratings_import->setImportacao($importacao);

        
        $path = storage_path('temp/rating_lbx_type_'.$tipo_modalidade.'_'.date("Ymd-His").'.xlsx');
        $file_path = fopen($path,'w');
        
        $client = new Client;
        $response = $client->get($this->links[$tipo_modalidade], ['save_to' => $file_path]);

        Excel::import($ratings_import, $path);
        return response(200);
    }
}
