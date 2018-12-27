<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Roll extends Model
{
    public $primaryKey = 'roll_ID';

    public function creator(){
        return $this->belongsTo('App\User', 'roll_CREATOR');
    }
    public function editor(){
        return $this->belongsTo('App\User', 'roll_EDITOR');
    }
    public function material(){
        return $this->belongsTo('App\Material', 'roll_MATERIAL_ID');
    }
}
