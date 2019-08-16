<?php

namespace App;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Order extends Model
{
    use Cachable;
    use Filterable;
    public $primaryKey = 'order_ID';
    protected $fillable = ['order_pp_ORDER', 'order_pp_ID'];

    public function modelFilter()
    {
        return $this->provideFilter(ModelFilters\OrderFilter::class);
    }

    public function creator(){
        return $this->belongsTo('App\User', 'order_CREATOR_ID');
    }
    public function editor(){
        return $this->belongsTo('App\User', 'order_EDITOR_ID');
    }
    public function roll(){
        return $this->belongsTo('App\Roll', 'order_ROLL_ID')->withDefault([
            'roll_NAME' => 'Brak'
        ]);
    }
    public function material(){
        return $this->belongsTo('App\Material', 'order_MATERIAL_ID')->withDefault([
            'material_NAME' => 'Brak'
        ]);
    }
    public function scopeWithoutTimestamps()
    {
        $this->timestamps = false;
        return $this;
    }
}
