<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envelope extends Model
{
    public $primaryKey = 'envelope_ID';

    public function packets(){
        return $this->hasMany('App\Envelopepacket', 'envelopepacket_ENVELOPE_ID');
    }
}
