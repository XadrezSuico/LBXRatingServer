<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;

class RatingController extends Controller
{
    public function searchByID($lbx_id){
        $ratings[0] = Rating::where([["lbx_id","=",$lbx_id],["tipo_modalidade","=",0]])->orderBy("created_at","DESC")->first();
        $ratings[1] = Rating::where([["lbx_id","=",$lbx_id],["tipo_modalidade","=",1]])->orderBy("created_at","DESC")->first();
        $ratings[2] = Rating::where([["lbx_id","=",$lbx_id],["tipo_modalidade","=",2]])->orderBy("created_at","DESC")->first();
        $array = array();
        
        foreach($ratings as $rating){
            if($rating){
                if($rating->lbx_id) $array["id"] = $rating->lbx_id;
                if($rating->nome) $array["nome"] = $rating->nome;
                if($rating->sobrenome) $array["sobrenome"] = $rating->sobrenome;
                if($rating->sexo) $array["sexo"] = $rating->sexo;
                if($rating->fed) $array["fed"] = $rating->fed;
                if($rating->codigo_cidade) $array["codigo_cidade"] = $rating->codigo_cidade;
                if($rating->nome_cidade) $array["nome_cidade"] = $rating->nome_cidade;
                if($rating->nascimento) $array["nascimento"] = $rating->nascimento;
                if($rating->tipo_modalidade > -1) $array["ratings"][$rating->getModalidade()] = $rating->rating;
            }
        }
        return response()->json($array);
    }
    public function searchFindByName(Request $request){
        $ratings = Rating::where([["nome","LIKE","%".$request->input("search")."%"]])
            ->orWhere([["sobrenome","LIKE","%".$request->input("search")."%"]])
            ->orWhere([["nome_completo","LIKE","%".$request->input("search")."%"]])
            ->orWhere([["nome_arquivo","LIKE","%".$request->input("search")."%"]])
            ->orWhere([["lbx_id","=",$request->input("search")]])
            ->orderBy("lbx_id","DESC")
            ->orderBy("created_at","DESC")
            ->get();
        $array = array();
        
        foreach($ratings as $rating){
            if($rating){
                if($rating->lbx_id) $array[$rating->lbx_id]["id"] = $rating->lbx_id;
                if($rating->nome) $array[$rating->lbx_id]["nome"] = $rating->nome;
                if($rating->sobrenome) $array[$rating->lbx_id]["sobrenome"] = $rating->sobrenome;
                if($rating->sexo) $array[$rating->lbx_id]["sexo"] = $rating->sexo;
                if($rating->fed) $array[$rating->lbx_id]["fed"] = $rating->fed;
                if($rating->codigo_cidade) $array[$rating->lbx_id]["codigo_cidade"] = $rating->codigo_cidade;
                if($rating->nome_cidade) $array[$rating->lbx_id]["nome_cidade"] = $rating->nome_cidade;
                if($rating->nascimento) $array[$rating->lbx_id]["nascimento"] = $rating->nascimento;
            }
        }
        return response()->json($array);
    }
}
