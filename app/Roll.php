<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Roll extends Model
{
    use Cachable;
    public $primaryKey = 'roll_ID';

    // Create Relation: [roll_CREATOR] --belongsto-->> [user_ID]
    public function creator(){
        return $this->belongsTo('App\User', 'roll_CREATOR');
    }

    // Create Relation: [roll_EDITOR] --belongsto-->> [user_ID]
    public function editor(){
        return $this->belongsTo('App\User', 'roll_EDITOR');
    }

    // Create Relation: [roll_MATERIAL_ID] --belongsto-->> [material_ID]
    public function material(){
        return $this->belongsTo('App\Material', 'roll_MATERIAL_ID');
    }

    // Create Relation: [roll_ID] <<--hasMany-- [order_ROLL_ID]
    public function orders(){
        return $this->hasMany('App\Order', 'order_ROLL_ID');
        // Used in: RollsController.php
    }
}
