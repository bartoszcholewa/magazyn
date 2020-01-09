<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envelopepacket extends Model
{
    public $primaryKey = 'envelopepacket_ID';

    public function envelope(){
        return $this->hasOne('App\Envelope', 'envelope_ID', 'envelopepacket_ENVELOPE_ID');
    }
}
