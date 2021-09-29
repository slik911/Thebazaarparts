<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
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

    public function sub_category(){
        return $this->belongsTo('App\Subcategory');
    }


    public function getProduct($slug){
        $product = DB::table('products')
        ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name', 'subcategories.slug as subcategory_slug', 'brands.name as brand_name', 'company_profiles.name as company_name', 'company_profiles.name as company_name', 'company_profiles.email as company_email', 'company_profiles.phone as company_phone', 'company_profiles.description as company_desc', 'company_profiles.slug as company_slug', 'company_profiles.website as company_website', 'company_profiles.logo as company_logo' )
        ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
        ->leftJoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
        ->leftJoin('brands', 'brands.id', '=', 'products.brand')
        ->leftJoin('company_profiles', 'company_profiles.user_id', '=', 'products.user_id')
        ->where('products.slug', '=', $slug)
        ->first();
        return $product;
    }

    public function review_data($product_id){
        $reviews_data = DB::table('reviews')->where('product_id', $product_id)->where('status', false)->latest()->cursor();


        return $reviews_data;
    }
    public function review_count($product_id){

        $review_count = DB::table('reviews')->where('product_id', $product_id)->where('status', false)->count();  
        return $review_count;
    }
}
