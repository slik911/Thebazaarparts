<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\FeaturedProduct;
use App\HotlistProduct;
use App\Jobs\SendContactEmail;
use App\Jobs\SendQuoteEmail;
use App\Product;
use App\Subcategory;

class IndexController extends Controller
{
    public function index(){

        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $new = new FeaturedProduct();
        $featured_products=$new->getAllFeaturedProduct()->paginate(8);

        $new2 = new HotlistProduct();
        $hotlist_products = $new2->getAllHotlistedProduct()->get();

        $platinum = DB::table('memberships')
                    ->select('company_profiles.*')
                    ->leftjoin('company_profiles', 'company_profiles.user_id', '=', 'memberships.user_id')
                    ->where('memberships.platinum', true)->get();

        return view('welcome', compact('categories', 'hotlist_products', 'featured_products', 'platinum'));

    }

    public function getState(Request $request){
        $states = State::where('country_id', $request->id)->cursor();
        return response()->json($states);
    }

    public function createCompanyProfile(){
        if(Auth::check()){
            $categories = DB::table('categories')->where('deleted', false)->cursor();
            return view('CreateCompanyProfile', compact('categories'));
        }
        else{
            return redirect('login');
        }
    }

    public function categories($category){
        $category = DB::table('categories')->where('name', $category)->first();
        $new = new Subcategory();
        $subcategories = $new->getSubCategory($category);
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        return view('categories', compact('subcategories', 'category', 'categories'));
    }

    public function product($category, $subcategory_slug=null){

        $category = DB::table('categories')->where('name', $category)->first();
        $subcategory = DB::table('subcategories')->where('slug', $subcategory_slug)->first();

        if($subcategory_slug == null){
            $products = DB::table('products')
                    ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name')
                        ->leftjoin('categories', 'categories.slug', '=', 'products.category_id')
                        ->leftjoin('subcategories', 'subcategories.slug', '=', 'products.subcategory_id')
            ->where('products.category_id', $category->slug)->where('products.expired', false)->where('products.status', true)->where('products.rejected', false)->where('products.deleted', false)->inRandomOrder()->paginate(16);
            $product_count = DB::table('products')->where('category_id', $category->id)->where('expired', false)->where('status', true)->where('rejected', false)->where('deleted', false)->count();

            $title = $category->name;
        }
        else{
            $products = DB::table('products')
                        ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name')
                        ->leftjoin('categories', 'categories.slug', '=', 'products.category_id')
                        ->leftjoin('subcategories', 'subcategories.slug', '=', 'products.subcategory_id')
                        ->where('products.subcategory_id', $subcategory->slug)->where('products.category_id', $category->slug)->where('products.expired', false)->where('products.status', true)->where('products.rejected', false)->where('products.deleted', false)->inRandomOrder()->paginate(16);

            $product_count = DB::table('products')->where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->where('expired', false)->where('status', true)->where('rejected', false)->where('deleted', false)->count();
            $title = $subcategory->name;
        }

        $new = new Subcategory();
        $subcategories = $new->getSubCategory($category);

        $countries = DB::table('countries')->cursor();
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $brands = DB::table('brands')->where('category_id', $category->slug)->where('deleted', false)->cursor();

        return view('products', compact('countries', 'subcategories', 'products', 'title', 'product_count', 'categories', 'category', 'brands'));
    }

    public function productsBrand($category, $brand_slug){
        $categories = Category::where('deleted', false)->cursor();
        $category = DB::table('categories')->where('name', $category)->first();
        $brand = DB::table('brands')->where('slug', $brand_slug)->first();

        $products = DB::table('products')
                    ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name')
                    ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
                    ->leftjoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
                    ->where('products.brand', $brand->id)->where('products.category_id', $category->id)->where('products.status', true)->paginate(16);

        $product_count = DB::table('products')->where('category_id', $category->id)->where('brand', $brand->id)->where('status', true)->count();

        $title = $brand->name;

        $new = new Subcategory();
        $subcategories = $new->getSubCategory($category);
        $countries = DB::table('countries')->cursor();
        $states = DB::table('states')->cursor();
        $brands = DB::table('brands')->where('category_id', $category->id)->where('deleted', false)->cursor();
        return view('products', compact('states', 'subcategories', 'products', 'title', 'product_count', 'categories', 'category', 'brands', 'countries'));
    }

    public function single_product($slug){
        $product_data = DB::table('products')->where('slug', $slug)->first();

        $new = new FeaturedProduct();
        $featured = $new->getAllFeaturedProduct()->cursor();


        $new2 = new Product();
        $product = $new2->getProduct($slug);
        $review_data = $new2->review_data($product_data->product_id);
        $review_count = $new2->review_count($product_data->product_id);

        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $membership = DB::table('memberships')->where('user_id', $product->user_id)->first();
        return view('single-product', compact('product', 'membership', 'categories', 'featured', 'review_data', 'review_count'));
    }

    public function single_featured_product($slug){
        $product_data = DB::table('featured_products')->where('slug', $slug)->first();
        $new = new FeaturedProduct();
        $product = $new->getFeaturedProduct($slug);




        $review_data = $new->review_data($product_data->product_id);
        $review_count = $new->review_count($product_data->product_id);

        $featured = $new->getAllFeaturedProduct()->cursor();
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $membership = DB::table('memberships')->where('user_id', $product->user_id)->first();

        return view('single-product', compact('product', 'categories', 'membership', 'featured', 'review_data', 'review_count'));
    }

    public function single_hotlist_product($slug){

        $product_data = DB::table('hotlist_products')->where('slug', $slug)->first();
        $new = new HotlistProduct();
        $product = $new->getHotlistedProduct($slug);


        $review_data = $new->review_data($product_data->product_id);
        $review_count = $new->review_count($product_data->product_id);

        $new2 = new FeaturedProduct();
        $featured = $new2->getAllFeaturedProduct()->cursor();
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $membership = DB::table('memberships')->where('user_id', $product->user_id)->first();

        return view('single-product', compact('product', 'categories', 'membership', 'featured', 'review_data', 'review_count'));
    }

    public function singleAuth($package, $slug){
        if($package == 'product'){
            return redirect()->route('parts.single-product', ['slug'=>$slug]);
        }
        else if($package == 'featured'){
            return redirect()->route('parts.single-featured-product', ['slug'=>$slug]);
        }
        else{
            return redirect()->route('parts.single-hotlist-product', ['slug'=>$slug]);
        }
    }

    public function company_profile($slug){
        $profile = DB::table('company_profiles')->where('slug', $slug)->where('status', true)->first();
        $new = new FeaturedProduct();
        $featured = $new->getAllFeaturedProduct()->cursor();
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $products = DB::table('products')
                    ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name')
                    ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
                    ->leftjoin('subcategories', 'subcategories.id', '=', 'products.category_id')
                    ->where('products.user_id', $profile->user_id)->where('products.expired', false)->where('products.status', true)->where('products.rejected', false)->where('products.deleted', false)->inRandomOrder()->take(8)->cursor();

        // dd($profile);
        $membership = DB::table('memberships')->where('user_id', $profile->user_id)->first();
        return view('company-profile', compact('profile', 'featured', 'membership', 'products', 'categories'));
    }

    public function companyProduct($company_slug){
        $profile = DB::table('company_profiles')->where('slug', $company_slug)->where('status', true)->where('verified', true)->first();
        $products = DB::table('products')
                    ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name')
                    ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
                    ->leftjoin('subcategories', 'subcategories.id', '=', 'products.category_id')
                    ->where('products.user_id', $profile->user_id)->where('products.expired', false)->where('products.status', true)->where('products.rejected', false)->where('products.deleted', false)->paginate(8);

                    $product_count= DB::table('products')
                    ->where('user_id', $profile->user_id)->where('expired', false)->where('status', true)->where('rejected', false)->where('deleted', false)->count();

        $title = $profile->name;
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $new = new FeaturedProduct();
        $featured = $new->getAllFeaturedProduct()->cursor();

        return view('companyProducts', compact('profile', 'products', 'title', 'product_count', 'categories', 'featured'));

    }

    public function productSearch(Request $request){
        $category = DB::table('categories')->where('id', $request->category)->first();
        $new = new Subcategory();
        $subcategories = $new->getSubCategory($category);
        $countries = DB::table('countries')->cursor();
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $brands = DB::table('brands')->where('category_id', $category->slug)->where('deleted', false)->cursor();

        $q = $request->search;
        $search_values = preg_split('/\s+/', $q, -1, PREG_SPLIT_NO_EMPTY);

        $products = DB::table('products')
                        ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name')
                        ->leftjoin('categories', 'categories.slug', '=', 'products.category_id')
                        ->leftjoin('subcategories', 'subcategories.slug', '=', 'products.subcategory_id')
                        ->where(function ($x) use($search_values){
                            foreach($search_values as $value){
                                $x->orWhere('products.name', 'like', '%'.$value.'%');
                                $x->orWhere('products.category_id', 'like', '%'.$value.'%');
                                $x->orWhere('products.brand', 'like', '%'.$value.'%');
                                $x->orWhere('products.subcategory_id', 'like', '%'.$value.'%');
                            }
                        })
                        ->where('products.category_id', $category->slug)->where('products.status', true)->where('products.rejected', false)->where('products.deleted', false)->paginate(16);

        $product_count = count($products);
        $title = $q;

        return view('products', compact('products', 'category', 'subcategories', 'countries', 'categories', 'brands', 'title', 'product_count'))->withQuery($q);
    }

    public function filter(Request $request, Product $product){

        $category = DB::table('categories')->where('name', $request->category)->first();

        $filters = [
            'country' => $request->country,
            'state' => $request->state,
            'min_price' => $request->min_price,
            'type' => $request->type,
            'max_price' => $request->max_price,
            'category_id' => $category->id,
        ];

        // dd($filters);
        $products = DB::table('products')->where(function ($query) use ($filters){
                    if($filters['country']){
                        $query->where('products.country_id', $filters['country']);
                    }
                    if($filters['state']){
                        $query->where('products.state_id', $filters['state']);
                    }
                    if($filters['type']){
                        $query->where('products.type', $filters['type']);
                    }
                    if($filters['min_price']){
                        $query->where('products.price', '>=', $filters['min_price']);
                    }
                    if($filters['max_price']){
                        $query->where('products.price', '<=', $filters['max_price']);
                    }
                })
        ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name')
        ->leftjoin('categories', 'categories.slug', '=', 'products.category_id')
        ->leftjoin('subcategories', 'subcategories.slug', '=', 'products.subcategory_id')
        ->where('products.category_id', $category->slug)
        ->paginate(16);

        $product_count = count($products);
        $countries = DB::table('countries')->cursor();
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $brands = DB::table('brands')->where('deleted', false)->where('category_id', $category->slug)->cursor();

        $title = "Filters";

        $new = new Subcategory();
        $subcategories = $new->getSubCategory($category);

        return view('products', compact('countries', 'subcategories', 'products', 'title', 'product_count', 'categories', 'category', 'brands'));
    }

    public function contact(){

            $categories = DB::table('categories')->where('deleted', false)->cursor();
            return view('contact', compact('categories'));

    }


public function sendContactMail(Request $request){

    $details = [
        'fullname'=> $request->name,
        'email' => $request->email,
        'phone' =>$request->phone,
        'company_name' => $request->company_name,
        'address' => $request->address,
        'message_type' => $request->type,
        'message' => $request->message,
    ];

    SendContactEmail::dispatch($details)
    ->delay(now()->addSeconds(10));

    $request->session()->flash('success', 'Mail sent successfully');
        return redirect()->back();

}

public function sendQuote(Request $request){


    // dd("submit");
    if($request->package == "product"){
        $url = route('parts.single-product', ['slug'=>$request->slug]);

    }
    else if($request->package == "featured"){
        $url = route('parts.single-featured-product', ['slug'=>$request->slug]);
    }
    else{
        $url = route('parts.single-hotlist-product', ['slug'=>$request->slug]);
    }


    $details = [
        'fullname'=> $request->name,
        'email' => $request->email,
        'phone' =>$request->phone,
        'company_name' => $request->company_name,
        'address' => $request->address,
        'product_id' => $request->product_id,
        'product_name' => $request->product_name,
        'url' => $url,
    ];

    $company_email = $request->company_email;
    $email = $request->email;


    SendQuoteEmail::dispatch($details, $email, $company_email)
    ->delay(now()->addSeconds(10));

    $request->session()->flash('success', 'Mail sent successfully, The seller will get back to you shortly');
        return redirect()->back();

    }

    public function sellers(){
        $sellers = DB::table('company_profiles')->where('verified', true)->paginate(16);
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        return view('sellers', compact('sellers', 'categories'));
    }

    Public function terms(){
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        return view('terms', compact('categories'));
    }

    Public function about(){
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        return view('about', compact('categories'));
    }

    Public function faq(){
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        return view('faq', compact('categories'));
    }

    Public function safety(){
        $categories = DB::table('categories')->where('deleted', false)->cursor();
        return view('safety', compact('categories'));
    }

}
