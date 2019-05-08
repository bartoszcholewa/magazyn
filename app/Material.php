<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

    public $primaryKey = 'material_ID';

    public function creator(){
        return $this->belongsTo('App\User', 'material_CREATOR_ID');
    }
    public function editor(){
        return $this->belongsTo('App\User', 'material_EDITOR_ID');
    }
    public function supplier(){
        return $this->belongsTo('App\Supplier', 'material_SUPPLIER');
    }
    public function rolls(){
        return $this->hasMany('App\Roll', 'roll_MATERIAL_ID');
    }
    public function orders(){
        return $this->hasMany('App\Order', 'order_MATERIAL_ID');
    }
}
