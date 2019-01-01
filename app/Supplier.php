<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $primaryKey = 'supplier_ID';

    public function creator(){
        return $this->belongsTo('App\User', 'supplier_CREATOR_ID');
    }
    
    public function editor(){
        return $this->belongsTo('App\User', 'supplier_EDITOR_ID');
    }

    public function materials(){
        return $this->hasMany('App\Material', 'material_SUPPLIER');
    }
}
