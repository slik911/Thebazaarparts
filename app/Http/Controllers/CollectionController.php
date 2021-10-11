<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Subcategory;
use App\Category;
use App\Brand;
use App\NotificationModel;

class CollectionController extends Controller
{

    public function category(){
        if(Auth::check()){
         $categories = Category::latest()->where('deleted', false)->cursor();
         $new = new NotificationModel;
         $data = $new->notifiable();
         return view('admin.category', compact('categories', 'data'));
        }
        else{
         return redirect('login');
        }
     }

     public function newCategory(Request $request){

         if(Auth::check()){
             if(DB::table('categories')->where('name', $request->name)->exists()){
                 $request->session()->flash('error', 'Category already  exists');
                 return redirect()->back();
             }
             else{
                 $new = new Category;
                 $new->name = $request->name;
                 if($request->file('image') !=  null)
                 {
                     $image = $request->file('image');
                     $filename = time() . '.' . $image->getClientOriginalExtension();
                     $location = public_path('images/category/'. $filename);
                     Image::make($image)->save($location);
                     $new->image = $filename;
                 }
                 $new->save();
                 $request->session()->flash('success', 'Category created successfully');
                 return redirect()->back();
             }
            }
            else{
             return redirect('login');
            }

     }

     public function getCategory(Request $request){
         $category = DB::table('categories')->where('id', $request->id)->first();
         return response()->json($category);
     }

     public function updateCategory(Request $request){
         $category = DB::table('categories')->where('id', $request->id)->first();

         if($request->file('image') !=  null)
         {
             File::delete('images/category/'.$category->image);
             $image = $request->file('image');
             $filename = time() . '.' . $image->getClientOriginalExtension();
             $location = public_path('images/category/'. $filename);
             Image::make($image)->save($location);
             $category = DB::table('categories')->where('id', $request->id)->update(["image"=>$filename]);
         }

         $category = DB::table('categories')->where('id', $request->id)->update(["name"=>$request->name]);

         $request->session()->flash('success', 'Category updated successfully');
         return redirect()->back();

     }

     public function deleteCategory(Request $request){
         $cat = Category::find($request->id)->first();
         File::delete('images/category/'.$cat->image);
         Category::find($request->id)->update(['deleted'=> true]);
         $request->session()->flash('success', 'Category deleted successfully');
             return redirect()->back();
     }

     public function subcategory(){
         if(Auth::check()){
             $categories = Category::where('deleted', false)->latest()->cursor();
             $subcategories = DB::table('subcategories')
                                ->select('subcategories.*', 'categories.name as category_name')
                                ->leftJoin('categories', 'categories.slug', 'subcategories.category_id')
                                ->where('subcategories.deleted', false)->latest()->cursor();
             $new = new NotificationModel;
            $data = $new->notifiable();
             return view('admin.subcategories', compact('categories', 'subcategories', 'data'));
         }
         else{
             return redirect('login');
         }
     }

     public function newsubCategory(Request $request){

        if(DB::table('subcategories')->where('category_id', $request->category)->where('name', $request->name)->exists()){
            $request->session()->flash('error', 'This subcategory already exists in this category');
            return back();
        }
        else{
            $new = new SubCategory;
            $new->category_id = $request->category;
            $new->name = $request->name;
            $new->save();
            $request->session()->flash('success', 'Category created successfully');
            return redirect()->back();
        }
     }

     public function getsubCategory(Request $request){
         $subcategory = DB::table('subcategories')->where('id', $request->id)->first();
         return response()->json($subcategory);
     }

     public function updatesubCategory(Request $request){
         $old_cat = DB::table('subcategories')->where('id', $request->id)->first();

         if($old_cat->category_id == $request->category && $old_cat->name == $request->category_name){
             return redirect()->back();
         }
         else{

             if(DB::table('subcategories')->where('category_id', $request->category)->where('name', $request->category_name)->where('id','!=', $old_cat->id)->exists()){
                 $request->session()->flash('error', 'This subcategory already exists in this category');
                 return back();
             }
             else{

                 DB::table('subcategories')->where('id', $request->id)->update(['category_id'=>$request->category, 'name'=>$request->category_name]);
                 $pp = SubCategory::findorfail($request->id);
                 $pp->slug = null;
                 $pp->save();
                 $request->session()->flash('success', 'Subcategory updated succesfully ');
                 return redirect()->back();
             }

         }

     }

     public function deletesubCategory(Request $request){

         SubCategory::where('id', $request->id)->update(['deleted'=> true]);
         $request->session()->flash('success', 'Subcategory deleted successfully');
             return back();
     }


     public function brand(){
         if(Auth::check()){
             $categories = Category::where('deleted', false)->cursor();
             $brands = DB::table('brands')
             ->select('brands.*', 'categories.name as category_name')
             ->leftJoin('categories', 'categories.slug', 'brands.category_id')
             ->where('brands.deleted', false)->latest()->cursor();
             $new = new NotificationModel;
        $data = $new->notifiable();

             return view('admin.brand', compact('categories', 'brands', 'data'));
         }
         else{
             return redirect('login');
         }
     }

     public function newbrand(Request $request){

        if(DB::table('brands')->where('category_id', $request->category)->where('name', $request->name)->exists()){
            $request->session()->flash('error', 'brand already  exists');
            return back();
        }
        else{
            $new = new Brand;
            $new->category_id = $request->category;
            $new->name = $request->name;
            $new->save();
            $request->session()->flash('success', 'brand created successfully');
            return back();
        }

     }

     public function getbrand(Request $request){
         $brand = DB::table('brands')->where('id', $request->id)->first();
         return response()->json($brand);
     }

     public function updatebrand(Request $request){
         $old_brand = DB::table('brands')->where('id', $request->id)->first();

         if($old_brand->category_id == $request->category && $old_brand->name == $request->name){
             return back();
         }
         else{

             if(DB::table('brands')->where('category_id', $request->category)->where('name', $request->name)->exists()){
                 $request->session()->flash('error', 'Brand already exists');
                 return back();
             }
             else{

                 DB::table('brands')->where('id', $request->id)->update(['category_id'=>$request->category, 'name'=>$request->name]);
                 $pp = Brand::findorfail($request->id);
                 $pp->slug = null;
                 $pp->save();
                 $request->session()->flash('success', 'Brand updated succesfully ');
                 return back();
             }

         }

     }

     public function deletebrand(Request $request){

         Brand::where('id', $request->id)->update(['deleted'=>true]);
         $request->session()->flash('success', 'Brand deleted successfully');
             return back();
     }
}
