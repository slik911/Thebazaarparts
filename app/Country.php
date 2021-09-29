<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function State(){
        return $this->hasMany('App\State');
    }
}
