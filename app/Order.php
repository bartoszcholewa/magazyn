<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $primaryKey = 'order_ID';

    protected $fillable = ['order_pp_ORDER', 'order_pp_ID'];




    public function creator(){
        return $this->belongsTo('App\User', 'order_CREATOR_ID');
    }
    public function editor(){
        return $this->belongsTo('App\User', 'order_EDITOR_ID');
    }
    public function roll(){
        return $this->belongsTo('App\Roll', 'order_ROLL_ID');
    }
    public function material(){
        return $this->belongsTo('App\Material', 'order_MATERIAL_ID');
    }
    public function scopeWithoutTimestamps()
    {
        $this->timestamps = false;
        return $this;
    }
}
