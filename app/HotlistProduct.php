<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class HotlistProduct extends Model
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

    
   public function getAllHotlistedProduct(){
    $hotlist_products = DB::table('hotlist_products')
    ->select('hotlist_products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name', 'subcategories.slug as subcategory_slug')
    ->leftJoin('categories', 'categories.id', '=', 'hotlist_products.category_id')
    ->leftJoin('subcategories', 'subcategories.id', '=', 'hotlist_products.subcategory_id')
    ->where('hotlist_products.rejected', false)->where('hotlist_products.expired', false) 
    ->where('hotlist_products.status', true)
    ->where('hotlist_products.deleted', false)->inRandomOrder();

    return $hotlist_products;
}

public function getHotlistedProduct($slug){
    $product = DB::table('hotlist_products')
    ->select('hotlist_products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name', 'subcategories.slug as subcategory_slug', 'brands.name as brand_name', 'company_profiles.name as company_name', 'company_profiles.name as company_name', 'company_profiles.email as company_email', 'company_profiles.phone as company_phone', 'company_profiles.description as company_desc', 'company_profiles.slug as company_slug', 'company_profiles.website as company_website', 'company_profiles.logo as company_logo' )
    ->leftJoin('categories', 'categories.id', '=', 'hotlist_products.category_id')
    ->leftJoin('subcategories', 'subcategories.id', '=', 'hotlist_products.subcategory_id')
    ->leftJoin('brands', 'brands.id', '=', 'hotlist_products.brand')
    ->leftJoin('company_profiles', 'company_profiles.user_id', '=', 'hotlist_products.user_id')
    ->where('hotlist_products.slug', '=', $slug)
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
