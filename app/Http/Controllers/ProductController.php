<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Support\Facades\DB;
use App\Country;
use App\Category;
use App\Product;
use App\ProductSlotManager;
use App\State;
use App\Subcategory;
use App\HotlistProduct;
use App\FeaturedProduct;
use App\Jobs\ProductApprovalMail;
use App\Jobs\ProductRejectedMail;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\NotificationModel;

class ProductController extends Controller
{

    public function random_strings($length_of_string) 
    { 
      
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
        return substr(str_shuffle($str_result),  
                           0, $length_of_string); 
    } 

    public function index(){
        if(Auth::check()){
            $countries = Country::cursor();
        $categories = Category::cursor();
        $new = new NotificationModel;
        $slot_data = $new->productNotification(); 
        return view('seller.newProduct', compact('countries', 'categories', 'slot_data'));
        }
        else{
            return redirect('login');
        }
    }

        public function getdata(Request $request){
            $sub = DB::table('subcategories')->where('category_id', $request->id)->get();
            $brand = DB::table('brands')->where('category_id', $request->id)->get();

            $data = ["sub"=>$sub, "brand"=>$brand];
            return response()->json($data);

        }

        public function create(Request $request){
            if($request->product_section == 'regular'){
                $count = DB::table('product_slot_managers')->where('user_id', Auth::user()->id)->where('package', 'Regular')->where('completed', false)->where('expired', false)->first();

                $status = DB::table('company_profiles')->where('user_id', auth::user()->id)->value('verified');
                if($count == null){
                    $request->session()->flash('error', 'Please purchase an economic package before uploading an item');
                    return Redirect::back()->withInput();  
                }
                else{
                    if($status == true){
                        if($count->total_slot_remaining > 0){
                            $new = new Product;
                            $new->slot_id = $count->slot_id;
                            $new->user_id = Auth::user()->id;
                            $new->product_id = (new ProductController)->random_strings(20);
                            $new->name = $request->name;
                            $new->price = $request->price;
                                if($request->image){
                        
                                $image = $request->file('image');
                                $filename = time() . '.' . 'jpg';
                                $location = public_path('images/products/'. $filename);
                                Image::make($image->getRealPath())->resize(400, 400, function($constraint){
                                    $constraint->aspectRatio();
                                    $constraint->upsize();
                                })->encode('jpg', 0)->save($location);
                                $new->image = $filename;
                                }
                            $new->category_id = $request->category;
                            $new->subcategory_id = $request->subcategory;
                            $new->brand = $request->brand;
                            $new->country_id = $request->country;
                            $new->state_id = $request->state;
                            $new->description = $request->description;
                            $new->type = $request->type;
                            $new->section = "product";
                            $new->expiry_date = $count->end_time;
                            $new->part_no = $request->part_no;
                            $new->save();
            
                            if($new){
                                $newCount = ProductSlotManager::where('slot_id', $count->slot_id)->first();
                                $newCount->total_slot_remaining =  $newCount->total_slot_remaining - 1;
                                if($newCount->total_slot_remaining == 0){
                                    $newCount->completed = true;
                                }
                                $newCount->save();
            
                                $request->session()->flash('success', 'Product has been uploaded successfully kindly wait while its been approved by the admin');
                                return redirect()->route('product.manage');
                            }
                            else{
                                $request->session()->flash('error', 'Sorry an error just occurred, please try again later.');
                                return redirect()->back();
                            }
            
                            
                        }
                        else{
                            $request->session()->flash('error', 'You have exhausted your product slot.');
                            return Redirect::back()->withInput();  
                        }
                    }
                    else{
                        $request->session()->flash('error', 'Unable to upload Product! Please update your profile and be patient while an admin approves your profile and try again ');
                        return redirect()->route('seller.profile');
                    }
                }
            }
            else if($request->product_section == 'featured'){
                $count = DB::table('product_slot_managers')->where('user_id', Auth::user()->id)->where('package', 'Featured')->where('completed', false)->where('expired', false)->first();

                if($count){

                            $status = DB::table('company_profiles')->where('user_id', auth::user()->id)->value('verified');
                            if($status == true){
                                if($count->total_slot_remaining > 0){
                                    $new = new FeaturedProduct;
                                    $new->slot_id = $count->slot_id;
                                    $new->user_id = Auth::user()->id;
                                    $new->product_id = (new ProductController)->random_strings(20);
                                    $new->name = $request->name;
                                    $new->price = $request->price;
                                        if($request->image){
                                        $image = $request->file('image');
                                        $filename = time() . '.' . 'jpg';
                                        $location = public_path('images/products/'. $filename);
                                        Image::make($image->getRealPath())->resize(400, 400, function($constraint){
                                            $constraint->aspectRatio();
                                            $constraint->upsize();
                                        })->encode('jpg', 0)->save($location);
                                        $new->image = $filename;
                                        }
                                    $new->category_id = $request->category;
                                    $new->subcategory_id = $request->subcategory;
                                    $new->brand = $request->brand;
                                    $new->country_id = $request->country;
                                    $new->state_id = $request->state;
                                    $new->description = $request->description;
                                    $new->type = $request->type;
                                    $new->section = "featured";
                                    $new->expiry_date = $count->end_time;
                                    $new->part_no = $request->part_no;
                                    $new->save();

                                    if($new){
                                        $newCount = ProductSlotManager::where('slot_id', $count->slot_id)->first();
                                        $newCount->total_slot_remaining =  $newCount->total_slot_remaining - 1;
                                        if($newCount->total_slot_remaining == 0){
                                            $newCount->completed = true;
                                        }
                                        $newCount->save();

                                        $request->session()->flash('success', 'Product has been uploaded successfully kindly wait while its been approved by the admin');
                                        return redirect()->route('featured_product.manage');
                                    }
                                    else{
                                        $request->session()->flash('error', 'Sorry an error just occurred, please try again later.');
                                        return Redirect::back()->withInput();
                                    }

                                    
                                }
                                else{
                                    $request->session()->flash('error', 'You have exhausted your product slot.');
                                    return Redirect::back()->withInput();
                                }
                            }
                            else{
                                $request->session()->flash('error', 'Unable to upload Product! Please update your profile and be patient while an admin approves your profile and try again ');
                                return redirect()->route('profile.seller');
                            }
                }
                else{
                    $request->session()->flash('error', 'Please kindly purchase a featured slot before uploading a new product');
                    return Redirect::back()->withInput();
                }
            }
            else{
                $count = DB::table('product_slot_managers')->where('user_id', Auth::user()->id)->where('package', 'Hotlist')->where('completed', false)->where('expired', false)->first();

                if($count){
        
                            $status = DB::table('company_profiles')->where('user_id', auth::user()->id)->value('verified');
                            if($status == true){
                                if($count->total_slot_remaining > 0){
                                    $new = new HotlistProduct;
                                    $new->slot_id = $count->slot_id;
                                    $new->user_id = Auth::user()->id;
                                    $new->product_id = (new ProductController)->random_strings(20).Auth::user()->id;
                                    $new->name = $request->name;
                                    $new->price = $request->price;
                                        if($request->image){
                                        $image = $request->file('image');
                                        $filename = (new ProductController)->random_strings(20).Auth::user()->id . '.' . 'jpg';
                                        $location = public_path('images/products/'. $filename);
                                        Image::make($image->getRealPath())->resize(200, 200, function($constraint){
                                            $constraint->aspectRatio();
                                            $constraint->upsize();
                                        })->encode('jpg', 0)->save($location);
                                        $new->image = $filename;
                                        }
                                    $new->category_id = $request->category;
                                    $new->subcategory_id = $request->subcategory;
                                    $new->brand = $request->brand;
                                    $new->country_id = $request->country;
                                    $new->state_id = $request->state;
                                    $new->description = $request->description;
                                    $new->type = $request->type;
                                    $new->section = "hotlist";
                                    $new->expiry_date = $count->end_time;
                                    $new->part_no = $request->part_no;
                                    $new->save();
        
                                    if($new){
                                        $newCount = ProductSlotManager::where('slot_id', $count->slot_id)->first();
                                        $newCount->total_slot_remaining =  $newCount->total_slot_remaining - 1;
                                        if($newCount->total_slot_remaining == 0){
                                            $newCount->completed = true;
                                        }
                                        $newCount->save();
        
                                        $request->session()->flash('success', 'Product has been uploaded successfully kindly wait while its been approved by the admin');
                                        return redirect()->route('hotlist_product.manage');
                                    }
                                    else{
                                        $request->session()->flash('error', 'Sorry an error just occurred, please try again later.');
                                        return Redirect::back()->withInput();
                                    }
        
                                    
                                }
                                else{
                                    $request->session()->flash('error', 'You have exhausted your Hotlist slot.');
                                    return Redirect::back()->withInput();  
                                }
                            }
                            else{
                                $request->session()->flash('error', 'Unable to upload Product! Please update your profile and be patient while an admin approves your profile and try again ');
                                return redirect()->route('profile.seller');
                            }
                }
                else{
                    $request->session()->flash('error', 'Please kindly purchase a hotlist slot before uploading a new product');
                    return Redirect::back()->withInput();
                }
            }
        }


        public function manage(){
            // Cache::forget('product');
            $products = DB::table('products')
                            ->select('products.*', 'hotlist_products.product_id as hotlist', 'featured_products.product_id as featured')
                            ->leftjoin('featured_products', 'featured_products.product_id', '=', 'products.product_id')
                            ->leftjoin('hotlist_products', 'hotlist_products.product_id', '=', 'products.product_id')    
                            ->where('products.user_id', auth::user()->id)->latest()->where('products.section', 'product')->cursor();   

            $new = new NotificationModel;
            $slot_data = $new->productNotification();          
            return view('seller.manageProducts', compact('products', 'slot_data'));
        }

        public function getProduct(Request $request){
            $products =  DB::table('products')
                        ->where('products.id', '=', $request->id)
                        ->first();
 
            return response()->json($products);
        }

        
        public function getCountry(Request $request){
            $state =  DB::table('states')
                        ->where('id', '=', $request->id)
                        ->first();
 
            return response()->json($state);
        }

        public function editProduct($slug){
            $product = DB::table('products')->where('slug', $slug)->first();
            $countries = Country::cursor();
            $categories = Category::where('deleted', false)->cursor();
            $subcategories = Subcategory::where('deleted', false)->cursor();
            $states = State::cursor();
            $brands = Brand::where('deleted', false)->cursor();
            $new = new NotificationModel;
            $slot_data = $new->productNotification(); 
            return view('seller.editProduct', compact('product', 'countries',  'categories', 'brands', 'states', 'subcategories', 'slot_data'));
        }

        public function updateProduct(Request $request){
             DB::table('products')->where('id', $request->id)->update([
                "name" => $request->name,
                "price" => $request->price,
                "category_id" => $request->category,
                "subcategory_id" => $request->subcategory,
                "brand" => $request->brand,
                "country_id" => $request->country,
                "state_id" => $request->state,
                "description" => $request->description,
                "type" => $request->type,
                "part_no" => $request->part_no,
                "status" =>false,
                "rejected" => false,
            ]);
                $pp = Product::findorfail($request->id);
                $pp->slug = null;
                $pp->save();

            $product = DB::table('products')->where('id', $request->id)->first();

            if($request->image){
    
               
                    File::delete('images/products/'.$product->image);
                    $image = $request->file('image');
                    $filename = (new ProductController)->random_strings(10).Auth::user()->id . '.' . $image->getClientOriginalExtension();
                    $location = public_path('images/products/'. $filename);
                    Image::make($image)->save($location);
                    DB::table('products')->where('id', $request->id)->update(["image"=>$filename]);
               
            }

            $request->session()->flash('success', 'Product updated successfully.');
            return redirect()->route('product.edit', $product->slug);

        }

        public function updateAvailability(Request $request){
            $product = Product::findorfail($request->id);
            $product->availability = !$product->availability;
            $product->save();

            if($product->availability == true){
                $request->session()->flash('success', 'Product availability changed to In stock');   
            }
            else{
                $request->session()->flash('success', 'Product availability changed to out of stock');
            }
            return redirect()->back();
        }


        public function deleteProduct(Request $request){
            $product = DB::table('products')->where('id', $request->id)->first();
          
            File::delete('images/products/'.$product->image);

            DB::table('product_slot_managers')->where('slot_id', $product->slot_id)->increment('total_slot_remaining', 1);
            DB::table('product_slot_managers')->where('slot_id', $product->slot_id)->update(['completed'=> false]);
             DB::table('products')->where('id', $request->id)->delete();
            $request->session()->flash('success', 'Product deleted successfully');
            return redirect()->back();
            
        }

        public function productManager(){
            if(Auth::check()){
                $products = DB::table('products')
                    ->select('products.*','company_profiles.name as company_name')
                    ->leftJoin('company_profiles', 'company_profiles.user_id', '=', 'products.user_id')
                    ->where('products.expired', false)->latest()->cursor();

                    $new = new NotificationModel;
                    $data = $new->notifiable();
                return view('admin.productManager', compact('products', 'data'));
            }
            else{
                return redirect('login');
            }
        }

        public function getProductDetails($slug){
            $product = DB::table('products')
                       ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name', 'brands.name as brand_name', 'states.name as state_name', 'countries.name as country_name')
                       ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
                       ->leftjoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
                       ->leftjoin('brands', 'brands.id', '=', 'products.brand')
                       ->leftjoin('countries', 'countries.id', '=', 'products.country_id')
                       ->leftJoin('states', 'states.id', '=', 'products.state_id')
                       ->where('products.slug', '=', $slug)->first();

                       $new = new NotificationModel;
                        $data = $new->notifiable();
                        $slot_data = $new->productNotification(); 
                       return view('admin.productDetails', compact('product', 'data', 'slot_data'));
        }

        public function approve(Request $request){
            DB::table('products')->where('id', $request->id)->update([
                'status'=>true,
                'approved'=>true,
            ]);

            $product_details = DB::table('products')
                               ->select('products.product_id as product_id', 'products.slug as slug', 'users.email as email')
                               ->leftJoin('users', 'users.id', '=', 'products.user_id')
                               ->where('products.id', $request->id)->first();
            
            
            $details = [
                'title'=>'Product Approval Notification',
                'url' => route('product.viewDetails', ['slug'=>$product_details->slug]),
                'product_id' =>$product_details->product_id
            ];

            $email = $product_details->email;
            ProductApprovalMail::dispatch($details, $email)
            ->delay(now()->addSeconds(10));

            $request->session()->flash('success', 'Product approved');
            return redirect()->back();
        }

        public function reject(Request $request){
            DB::table('products')->where('id', $request->id)->update([
                'rejected'=>true
            ]);

            $product_details = DB::table('products')
            ->select('products.product_id as product_id', 'products.slug as slug', 'users.email as email')
            ->leftJoin('users', 'users.id', '=', 'products.user_id')
            ->where('products.id', $request->id)->first();

            $details = [
                'title'=>'Product Rejection Notification',
                'url' => route('product.viewDetails', ['slug'=>$product_details->slug]),
                'product_id' =>$product_details->product_id
            ];

            $email = $product_details->email;;
            ProductRejectedMail::dispatch($details, $email)
            ->delay(now()->addSeconds(10));

            $request->session()->flash('success', 'Product Rejected');
            return redirect()->back();
        }
    
}
