<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RatingsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Importacao;
use App\Rating;

class ImportacaoController extends Controller
{
	public function __construct(){
		return $this->middleware("auth");
    }
    
    public function index(){
        $importacoes = Importacao::all();
        return view("importacao.index",compact("importacoes"));
    }
    
    public function new(){
        return view("importacao.new");
    }
    
    public function new_post(Request $request){
        // $this->validate($request, [
        //     'arquivo'  => 'required|mimes:xls,xlsx'
        // ]);

        $importacao = new Importacao;
        $importacao->tipo_modalidade = $request->input("tipo_modalidade");
        $importacao->e_automatico = false;
        $importacao->save();

        $ratings_import = new RatingsImport;
        $ratings_import->setImportacao($importacao);

        Excel::import($ratings_import, $request->file('arquivo'));
        return redirect('/')->with('success', 'All good!');
    }

    
}
