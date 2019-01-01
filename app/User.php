<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function materials_creator(){
        return $this->hasMany('App\Material', 'material_CREATOR_ID');
    }

    public function materials_editor(){
        return $this->hasMany('App\Material', 'material_EDITOR_ID');
    }

    public function suppliers_creator(){
        return $this->hasMany('App\Supplier', 'supplier_CREATOR_ID');
    }

    public function suppliers_editor(){
        return $this->hasMany('App\Supplier', 'supplier_EDITOR_ID');
    }

    public function rolls_creator(){
        return $this->hasMany('App\Roll', 'roll_CREATOR');
    }

    public function rolls_editor(){
        return $this->hasMany('App\Roll', 'roll_EDITOR');
    }

    public function orders_creator(){
        return $this->hasMany('App\Order', 'order_CREATOR_ID');
    }

    public function orders_editor(){
        return $this->hasMany('App\Order', 'order_EDITOR_ID');
    }
    

}
