<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Country;
use App\State;
use App\User;
use App\NotificationModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()){
            if(auth::user()->role == "buyer"){
                return redirect()->route('parts');
            }
            else if(auth::user()->role == "admin"){

                $category = DB::table('categories')->where('deleted', false)->count();
                $model = DB::table('brands')->where('deleted', false)->count();
                $subcategory = DB::table('subcategories')->where('deleted', false)->count();
                $product = DB::table('products')->where('status', true)->where('expired', false)->where('deleted', false)->count();
                $featured = DB::table('featured_products')->where('status', true)->where('expired', false)->where('deleted', false)->count();
                $hotlist = DB::table('hotlist_products')->where('status', true)->where('expired', false)->where('deleted', false)->count();

                $buyer = DB::table('users')->where('role', 'buyer')->where('status', false)->count();
                $seller = DB::table('users')->where('role', 'seller')->where('status', false)->count();

                $economic_plan = DB::table('payments')->where('package', "economic")->where('refunded', false)->sum('price');
                $membership = DB::table('payments')->where('package', "membership")->orwhere('package', "membership renewal")->where('refunded', false)->sum('price');
                $verified = DB::table('memberships')->where('verified', true)->count();
                $reviews = DB::table('reviews')->count();

                $new = new NotificationModel;
                $data = $new->notifiable();
                return view('admin.home', compact('category', 'model', 'subcategory', 'product', 'hotlist', 'featured', 'hotlist', 'buyer', 'seller', 'economic_plan', 'membership', 'verified', 'reviews', 'data'));
                // return view('admin.home');
            }
            else{
                $regular_count = DB::table('product_slot_managers')->where('user_id', Auth::user()->id)->where('package', 'regular')->where('completed', false)->where('expired', false)->sum('total_slot_remaining');
                $featured_count = DB::table('product_slot_managers')->where('user_id', Auth::user()->id)->where('package', 'featured')->where('completed', false)->where('expired', false)->sum('total_slot_remaining');
                $hotlist_count = DB::table('product_slot_managers')->where('user_id', Auth::user()->id)->where('package', 'hotlist')->where('completed', false)->where('expired', false)->sum('total_slot_remaining');

                $product = DB::table('products')->where('user_id', auth::user()->id)->where('status', true)->where('expired', false)->where('deleted', false)->count();
                $featured = DB::table('featured_products')->where('user_id', auth::user()->id)->where('status', true)->where('expired', false)->where('deleted', false)->count();
                $hotlist = DB::table('hotlist_products')->where('user_id', auth::user()->id)->where('status', true)->where('expired', false)->where('deleted', false)->count();
                $new = new NotificationModel;
                $slot_data = $new->productNotification();
                $verification_status = DB::table('memberships')->where('user_id', auth::user()->id)->first();
                $reviews = DB::table('reviews')->where('seller_id', auth::user()->id)->count();
                $profile_complete = DB::table('company_profiles')->where('user_id', Auth::user()->id)->first();

                return view('seller.dashboard', compact('profile_complete', 'regular_count', 'featured_count', 'hotlist_count', 'verification_status', 'product', 'featured', 'hotlist', 'reviews', 'slot_data'));
            }
        }
        else{
            return redirect('login');
        }
    }

    public function sellerProfile()
    {
        if(auth::check()){
            $country = Country::cursor();
            $state = State::cursor();
            $data = DB::table('company_profiles')->where('user_id', auth::user()->id)->first();
            $profile = null;
            if($data != null){
                $profile = $data;
            }
            else{
                $p = ["user_id"=> null, "name" => null, "slug"=> null, "address" => null,"phone"=> null, "email" => null, "business_type"=> null, "website" => null, "logo"=> null, "description" => null ];
                $profile = (object) $p;
            }

            $new = new NotificationModel;
            $slot_data = $new->productNotification();

            return view('seller.profile', compact('country', 'state', 'profile', 'slot_data'));
        }
        else{
            return view('login');
        }

    }

    public function adminProfile()
    {
        if(auth::check()){
            $country = Country::cursor();
            $state = State::cursor();
            $new = new NotificationModel;
            $data = $new->notifiable();
            $slot_data = $new->productNotification();
            return view('admin.profile', compact('country', 'state', 'data'));
        }
        else{
            return view('login');
        }

    }


    public function buyerProfile()
    {
        if(auth::check()){
            $country = Country::cursor();
            $state = State::cursor();
            $categories = Category::where('deleted', false)->cursor();
            return view('profile', compact('country', 'state', 'categories'));
        }
        else{
            return view('login');
        }

    }
    public function updateProfile(Request $request){

        if(auth::user()->email == $request->email){
            DB::table('users')->where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'country_id' =>$request->country,
                'address' => $request->address,
                'state_id' => $request->state
            ]);

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://thebazaarcommunity.com/api/update/profile/'.$request->email, [
                'form_params' => [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address'=> $request->address,
                ]
            ]);
            $request->session()->flash('success', 'Profile updated successful');
            return redirect()->back();
        }
        else{
            if(DB::table('users')->where('email', $request->email)->exists()){
                $request->session()->flash('error', 'Email already exists');
                return redirect()->back();
            }
            else{
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'country_id' =>$request->country,
                    'state_id' => $request->state
                ]);

                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'https://thebazaarcommunity.com/api/update/profile/'.$request->email, [
                    'form_params' => [
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'address'=> $request->address,
                    ]
                ]);
                $request->session()->flash('success', 'Profile updated successful');
            return redirect()->back();
            }
        }


    }


    public function region(Request $request){
        $user = User::findorfail($request->id);
        return response()->json($user);
    }
}
