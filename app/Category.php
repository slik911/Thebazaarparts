<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Sub_categories(){
        return $this->hasMany('App\Sub_Category');
    }

    public function brands(){
        return $this->hasMany('App\Brand');
    }
}
