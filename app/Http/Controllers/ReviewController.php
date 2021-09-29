<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Review;
use App\NotificationModel;

class ReviewController extends Controller
{
    public function upload(Request $request){
        $new = new Review;
        if(Auth::check()){
            $new->full_name = Auth::user()->name;
            $new->email = Auth::user()->email;
        }
        else{
            $new->full_name = $request->name;
            $new->email = $request->email;
        }
            $new->product_id = $request->id;
            $new->seller_id = $request->user_id;
            $new->review = $request->review;
            $new->save();
            $request->session()->flash('success', 'Review uploaded successfully');
            return redirect()->back();  
    }


    public function getAllReviews(){

        if(Auth::check()){
            $new = new NotificationModel;
            $data = $new->notifiable();
            $reviews = DB::table('reviews')
            ->select('reviews.*','products.slug as product_slug','featured_products.slug as featured_slug','hotlist_products.slug as hotlist_slug')
            ->leftjoin('products', 'products.product_id', '=', 'reviews.product_id') 
            ->leftjoin('featured_products', 'featured_products.product_id', '=', 'reviews.product_id') 
            ->leftjoin('hotlist_products', 'hotlist_products.product_id', '=', 'reviews.product_id') 
            ->latest()
            ->cursor();
            return view('admin.reviews', compact('reviews', 'data'));
        }
        else{
            return redirect('login');
        }
       
    }

    public function changeStatus(Request $request){
        $review = Review::where('id', $request->id)->first();
        $review->status = !$review->status;
        $review->save();

        if($review->status == true){
            $request->session()->flash('success', 'Review has been hidden');
         
        }
        else{
            $request->session()->flash('success', 'Review has been unhidden');
          
        }

        return redirect()->back(); 
    }

    public function delete(Request $request){
        DB::table('reviews')->where('id', $request->id)->delete();
        $request->session()->flash('success', 'Review has been deleted');
        return redirect()->back(); 
    }

    public function getMyReviews(){

        if(Auth::check()){
            $new = new NotificationModel;
            $slot_data = $new->productNotification();
            $reviews = DB::table('reviews')
            ->select('reviews.*','products.slug as product_slug', 'featured_products.slug as featured_slug','hotlist_products.slug as hotlist_slug')
            ->leftjoin('products', 'products.product_id', '=', 'reviews.product_id') 
            ->leftjoin('featured_products', 'featured_products.product_id', '=', 'reviews.product_id') 
            ->leftjoin('hotlist_products', 'hotlist_products.product_id', '=', 'reviews.product_id') 
            ->where('reviews.seller_id', Auth::user()->id)
            ->latest()
            ->get();
            // dd($reviews);
            return view('seller.reviews', compact('reviews', 'slot_data'));
        }
        else{
            return redirect('login');
        }
       
    }


    public function getReview(Request $request){
        $review = DB::table('reviews')->where('id', $request->id)->first();
        return response()->json($review);
    }
}
