<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Rating extends Model
{
    use LogsActivity;

    protected $fillable = ['*'];

    protected static $logFillable = true;

    protected static $logAttributes = ['*'];

    public function getModalidade(){
        if($this->tipo_modalidade > -1){
            switch($this->tipo_modalidade){
                case 0:
                    return "STD";
                case 1:
                    return "RPD";
                case 2:
                    return "BTZ";
            }
        }
        return false;
    }
}
