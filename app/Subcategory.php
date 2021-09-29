<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subcategory extends Model
{
    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator('_');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function products(){
        return $this->hasMany('App\Prouct');
    }
    public function getSubCategory($category){
        $subcategorys = DB::table('subcategories')->where('category_id', $category->id)->where('deleted', false)->cursor();
        $subcategori = [];

        foreach ($subcategorys as $sub) {
            $row = [];
            $row["id"] = $sub->id;
            $row["name"] = $sub->name;
            $row["slug"] = $sub->slug;
            $row["count"] = DB::table('products')->where('subcategory_id', $sub->id)->where('category_id', $category->id)->where('status', true)->count();
            $subcategori[] = $row;
        }

     
       $subcategory = json_decode(json_encode($subcategori));

        return $subcategory;
    }

    
}
