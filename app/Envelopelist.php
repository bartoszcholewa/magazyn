<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envelopelist extends Model
{
    public $primaryKey = 'envelopelist_ID';

    public function packets(){
        return $this->hasMany('App\Envelopepacket', 'envelopepacket_ENVELOPELIST_ID');
    }
}
