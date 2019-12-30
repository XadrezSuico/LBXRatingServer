<?php

namespace App\Imports;

use App\Rating;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use DateTime;

class RatingsImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $importacao;
    

    public function setImportacao($importacao){
        $this->importacao = $importacao;
    }

    public function model(array $row)
    {
        if($this->importacao != NULL){
            $nascimento = $this->convertNascimentoToDate($row["birthday"]);
            $nome_explode = explode(",",$row["name"]);

            $rating = new Rating;
            $rating->importacaos_id = $this->importacao->id;

            if(count($nome_explode) == 2){
                $rating->nome = $nome_explode[1];
                $rating->sobrenome = $nome_explode[0];
                $rating->nome_completo = $nome_explode[1]." ".$nome_explode[0];
            }else{
                $rating->nome = $row["name"];
                $rating->sobrenome = $row["name"];
                $rating->nome_completo = $row["name"];
            }


            $rating->nome_arquivo = $row["name"];
            $rating->lbx_id = $row["id_no"];
            $rating->sexo = $row["sex"];
            $rating->fed = $row["fed"];
            $rating->codigo_cidade = $row["clubnumber"];
            $rating->nome_cidade = $row["clubname"];
            if($nascimento) $rating->nascimento = $nascimento;
            $rating->rating = $row["rtg_int"];
            $rating->k = $row["k"];
            $rating->tipo_modalidade = $this->importacao->tipo_modalidade;
            return $rating;

            // return new Rating([
            //     'importacaos_id' => $this->importacao->id,
            //     'nome_arquivo' => $row["name"],
            //     'lbx_id' => $row["id_no"],
            //     'sexo' => $row["sex"],
            //     'fed' => $row["fed"],
            //     'codigo_cidade' => $row["clubnumber"],
            //     'nome_cidade' => $row["clubname"],
            //     'nascimento' => $this->convertNascimentoToDate($row["birthday"]),
            //     'rating' => $row["rtg_int"],
            //     'k' => $row["k"],
            // ]);
        }
        return false;
    }

    private function convertNascimentoToDate($nascimento){
        $datetime = DateTime::createFromFormat('d.m.Y', $nascimento);
        if($datetime){
            return $datetime->format("Y-m-d");
        }else
            return false;
    }

    // public function sheets(): array
    // {
    //     $ratings_import = $this;
    //     return [
    //         // Select by sheet index
    //         0 => $ratings_import,
    //     ];
    // }
    public function sheets(): array
    {
        $ratings_import = $this;
        return [
            'Plan1' => $ratings_import,
        ];
    }
    
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
