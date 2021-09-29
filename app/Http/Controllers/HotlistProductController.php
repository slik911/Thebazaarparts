<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\ProductSlotManager;
use Illuminate\Support\Facades\DB;
use App\HotlistProduct;
use App\Jobs\ProductApprovalMail;
use App\Jobs\ProductRejectedMail;
use App\State;
use App\Subcategory;
use App\NotificationModel;

class HotlistProductController extends Controller
{
    public function manage(){
        $products = DB::table('hotlist_products')->where('user_id', auth::user()->id)->latest()->cursor();
        $products_id = DB::table('products')->where('status', true)->where('rejected', false)->where('expired', false)->where('deleted', false)->pluck('product_id');        
        $new = new NotificationModel;
        $slot_data = $new->productNotification();      
        return view('seller.manageHotlistProducts', compact('products', 'products_id', 'slot_data'));
    }



    public function getProductDetails($slug){
        $product = DB::table('hotlist_products')
                   ->select('hotlist_products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name', 'brands.name as brand_name', 'states.name as state_name', 'countries.name as country_name')
                   ->leftjoin('categories', 'categories.id', '=', 'hotlist_products.category_id')
                   ->leftjoin('subcategories', 'subcategories.id', '=', 'hotlist_products.subcategory_id')
                   ->leftjoin('brands', 'brands.id', '=', 'hotlist_products.brand')
                   ->leftjoin('countries', 'countries.id', '=', 'hotlist_products.country_id')
                   ->leftJoin('states', 'states.id', '=', 'hotlist_products.state_id')
                   ->where('hotlist_products.slug', '=', $slug)->first();

                   $new = new NotificationModel;
                   $data = $new->notifiable();
                   $slot_data = $new->productNotification();  
                   return view('admin.productDetails', compact('product', 'data', 'slot_data'));
    }

    public function editProduct($slug){
        $product = DB::table('hotlist_products')->where('slug', $slug)->first();
        // dd($product);
        $countries = Country::cursor();
        $categories =  Category::where('deleted', false)->cursor();
        $subcategories = Subcategory::where('deleted', false)->cursor();
        $states = State::cursor();
        $brands = Brand::where('deleted', false)->cursor();
        $new = new NotificationModel;
        $slot_data = $new->productNotification();  
        return view('seller.editHotlistProduct', compact('product', 'countries',  'categories', 'brands', 'states', 'subcategories', 'slot_data'));
    }

    public function getProduct(Request $request){
        $products =  DB::table('hotlist_products')
                    ->where('hotlist_products.id', '=', $request->id)
                    ->first();

        return response()->json($products);
    }

    public function updateProduct(Request $request){
            DB::table('hotlist_products')->where('id', $request->id)->update([
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
            "approved" => false,
            "rejected" => false,
        ]);
            $pp = HotlistProduct::findorfail($request->id);
            $pp->slug = null;
            $pp->save();

        $product = DB::table('hotlist_products')->where('id', $request->id)->first();

        if($request->image){
                File::delete('images/products/'.$product->image);
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/products/'. $filename);
                Image::make($image)->save($location);
                DB::table('hotlist_products')->where('id', $request->id)->update(["image"=>$filename]);    
            }

        $request->session()->flash('success', 'Product updated successfully.');
        return redirect()->route('hotlist_product.edit', $product->slug);

    }

    public function uploadExistingProduct(Request $request){

        $count = DB::table('product_slot_managers')->where('user_id', Auth::user()->id)->where('package', 'Hotlist')->where('completed', false)->where('expired', false)->first();

        if($count){

                    $status = DB::table('company_profiles')->where('user_id', auth::user()->id)->value('verified');
                    if($status == true){
                        if($count->total_slot_remaining > 0){
                           
                            $product = DB::table('products')->where('product_id', $request->product_id)->first();
                            if(DB::table('hotlist_products')->where('product_id', $request->product_id)->exists()){
                                $request->session()->flash('error', 'Products has already been uploaded, please check and try again');
                                return redirect()->back();
                            }
                            else{
                                $new = new HotlistProduct;
                                $new->slot_id = $count->slot_id;
                                $new->user_id = Auth::user()->id;
                                $new->product_id = $product->product_id;
                                $new->name = $product->name;
                                $new->price = $product->price; 


                                $oldpath = 'images/products/'.$product->image;
                                $fileExtension = File::extension($oldpath);
                                $newName = 'hotlist'.time().'.'.$fileExtension;
                                $newPathWithName = 'images/products/'.$newName;
                                File::copy($oldpath, $newPathWithName);

                                $new->image = $newName; 
                                $new->category_id = $product->category_id;
                                $new->subcategory_id = $product->subcategory_id;
                                $new->brand = $product->brand;
                                $new->country_id = $product->country_id;
                                $new->state_id = $product->state_id;
                                $new->description = $product->description;
                                $new->type = $product->type;
                                $new->section = "hotlist";
                                $new->expiry_date = $count->end_time;
                                $new->part_no = $product->part_no;
                                if ($product->status) {
                                    $new->status = true;
                                }
                                $new->save();

                                if($new){
                                    $newCount = ProductSlotManager::where('slot_id', $count->slot_id)->first();
                                    $newCount->total_slot_remaining =  $newCount->total_slot_remaining - 1;
                                    if($newCount->total_slot_remaining == 0){
                                        $newCount->completed = true;
                                    }
                                    $newCount->save();
    
                                    $request->session()->flash('success', 'Product added to Hotlist');
                                    return redirect()->route('product.manage');
                                }
                                else{
                                    $request->session()->flash('error', 'Sorry an error just occurred, please try again later.');
                                    return redirect()->back();
                                }
                            }    
                        }
                        else{
                            $request->session()->flash('error', 'You have exhausted your product slot.');
                            return redirect()->back();  
                        }
                    }
                    else{
                        $request->session()->flash('error', 'Unable to upload Product! Please update your profile and be patient while an admin approves your profile and try again ');
                        return redirect()->route('seller.profile');
                    }
        }
        else{
            $request->session()->flash('error', 'Please kindly purchase a featured slot before uploading a new product');
            return redirect()->back();
        }
        
    }


    public function deleteProduct(Request $request){
        $product_hotlist = DB::table('hotlist_products')->where('product_id', $request->id)->first();

        File::delete('images/products/'.$product_hotlist->image);
        

        DB::table('product_slot_managers')->where('slot_id', $product_hotlist->slot_id)->increment('total_slot_remaining', 1);
        DB::table('product_slot_managers')->where('slot_id', $product_hotlist->slot_id)->update(['completed'=> false]);
        DB::table('hotlist_products')->where('product_id', $request->id)->delete();
        $request->session()->flash('success', 'Product deleted successfully');
        return redirect()->back();
        
    }

    public function updateAvailability(Request $request){
        $product = HotlistProduct::findorfail($request->id);
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

    public function productManager(){
        if(Auth::check()){
            $products = DB::table('hotlist_products')
                ->select('hotlist_products.*','company_profiles.name as company_name')
                ->leftJoin('company_profiles', 'company_profiles.user_id', '=', 'hotlist_products.user_id')
                ->where('hotlist_products.expired', false)->latest()->cursor();

                $new = new NotificationModel;
                $data = $new->notifiable();
            return view('admin.hotlistProductmanager', compact('products', 'data'));
        }
        else{
            return redirect('login');
        }
    }

    public function approve(Request $request){
        DB::table('hotlist_products')->where('id', $request->id)->update([
            'status'=>true,
            'approved'=>true,
        ]);

        $product_details = DB::table('hotlist_products')
                           ->select('hotlist_products.product_id as product_id', 'hotlist_products.slug as slug', 'users.email as email')
                           ->leftJoin('users', 'users.id', '=', 'hotlist_products.user_id')
                           ->where('hotlist_products.id', $request->id)->first();
        
        
        $details = [
            'title'=>'Product Approval Notification',
            'url' => route('product.viewhotlistDetails', ['slug'=>$product_details->slug]),
            'product_id' =>$product_details->product_id
        ];
        $email = $product_details->email;
        ProductApprovalMail::dispatch($details, $email)
        ->delay(now()->addSeconds(10));


        $request->session()->flash('success', 'Product approved');
        return back();
    }

    public function reject(Request $request){
        DB::table('hotlist_products')->where('id', $request->id)->update([
            'rejected'=>true
        ]);

        $product_details = DB::table('hotlist_products')
        ->select('hotlist_products.product_id as product_id', 'hotlist_products.slug as slug', 'users.email as email')
        ->leftJoin('users', 'users.id', '=', 'hotlist_products.user_id')
        ->where('hotlist_products.id', $request->id)->first();

        $details = [
            'title'=>'Product Rejection Notification',
            'url' => route('product.viewhotlistDetails', ['slug'=>$product_details->slug]),
            'product_id' =>$product_details->product_id
        ];

        $email = $product_details->email;
        ProductRejectedMail::dispatch($details, $email)
        ->delay(now()->addSeconds(10));

        $request->session()->flash('success', 'Product rejected');
        return back();
    }
}
