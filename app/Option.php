<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Option extends Model
{
    use Cachable;
    public $primaryKey = 'option_ID';
}
