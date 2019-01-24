<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PlanPlastykow extends Model
{
    protected $table = 'planplastykow';
    public $primaryKey = 'pp_ID';
    


    public function orders(){
        return $this->hasMany('App\Order', 'order_pp_ID')->orderBy('order_pp_Order', 'asc');
    }

    
}
