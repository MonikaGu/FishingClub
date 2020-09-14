<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservoir extends Model
{
    public $fillable = ['title', 'area', 'about'];

    public function members(){
        return $this->hasMany('App\Member');
    }
}
