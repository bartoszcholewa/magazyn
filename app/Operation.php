<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    public $primaryKey = 'operation_ID';

    public function user(){
        return $this->belongsTo('App\User', 'operation_USER_ID');
    }
}
