<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\NotificationModel;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function buyer(){
        if(auth::check()){
            $users = User::latest()->where('role', 'buyer')->where('deleted', false)->cursor();
            $new = new NotificationModel;
            $data = $new->notifiable();
            return view('admin.buyer', compact('users', 'data'));
        }
        else{
            return view('login');
        }
    }
    public function seller(){
        if(auth::check()){
            $users = User::latest()->where('role', 'seller')->where('deleted', false)->cursor();
            $new = new NotificationModel;
            $data = $new->notifiable();
            return view('admin.seller', compact('users', 'data'));
        }
        else{
            return view('login');
        }
    }
    public function viewDetails($email){

        if(auth::check()){
            $user =DB::table('users')
            ->select('users.*', 'company_profiles.description as company_description', 'company_profiles.logo as company_logo', 'company_profiles.website as company_website',  'company_profiles.name as company_name','company_profiles.address as company_address', 'company_profiles.phone as company_phone', 'company_profiles.email as company_email', 'company_profiles.status as company_status', 'company_profiles.business_type as company_business_type',  'countries.id as country_id', 'countries.name as country_name', 'states.id as state_id', 'states.name as state_name')
            ->leftJoin('company_profiles', 'company_profiles.user_id', '=', 'users.id')
            ->leftJoin('countries', 'countries.id', '=', 'users.country_id')
            ->leftJoin('states', 'states.id', '=', 'users.state_id')
            ->where('users.email', $email)->first();
            $new = new NotificationModel;
            $data = $new->notifiable();

        return view('admin.view_seller_details', compact('user', 'data'));
        }
        else{
            return view('login');
        }
    }

    public function deleteUser(Request $request){
        DB::table('users')->where('id', $request->id)->update(['deleted'=>true]);
        $request->session()->flash('success', 'Users deleted successfully');
        return redirect()->back();
    }

    public function blockUser(Request $request){
        $user = User::findorfail($request->id);
        // $user->status = !$user->status;
        $user->active = !$user->active;
        $user->save();

        if($user->status == true){
            $request->session()->flash('success', 'User has been successfully blocked');   
        }
        else{
            $request->session()->flash('success', 'User has been activated successfully');
        }
        return redirect()->back();

    }

    public function verifyUser(Request $request){
        DB::table('company_profiles')->where('user_id', $request->id)->update([
            'verified' => true,
        ]);

        $request->session()->flash('success', 'User has been successfully verified');
        return redirect()->back();

    }

    public function premiumMembers(){

        if(auth::check()){
            $members = DB::table('memberships')
            ->select('memberships.*', 'users.name as name', 'users.email as email', 'company_profiles.name as company_name')
            ->leftJoin('users', 'users.id', '=', 'memberships.user_id')
            ->leftJoin('company_profiles', 'company_profiles.id', '=', 'memberships.company_id')
            ->orderByDesc('updated_at')->cursor();
            
            $new = new NotificationModel;
            $data = $new->notifiable();

            return view('admin.premium_members', compact('members', 'data'));
        }
        else{
            return view('login');
        }

    }

    public function manageAccount()
    {
        $new = new NotificationModel;
        $slot_data = $new->productNotification();
        return view('seller.manage_account', compact('slot_data'));
    }

    public function deleteSellerAccount(Request $request){
        $profile = DB::table('company_profiles')->where('user_id', Auth::user()->id)->first();
        if($profile){
            File::delete('images/company_logo/'.$profile->logo);
            DB::table('company_profiles')->where('user_id', Auth::user()->id)->delete();
        }

        $featureds = DB::table('featured_products')->where('user_id', Auth::user()->id)->get();
        if($featureds){
            foreach($featureds as $featured){
                File::delete('images/products/'.$featured->image);
                DB::table('featured_products')->where('id', $featured->id)->delete();
            }
        }

        $products = DB::table('products')->where('user_id', Auth::user()->id)->get();
        if($products){
            foreach($products as $product){
                File::delete('images/products/'.$product->image);
                DB::table('products')->where('id', $product->id)->delete();
            }
        }

        $hotlists = DB::table('hotlist_products')->where('user_id', Auth::user()->id)->get();
        if($hotlists){
            foreach($hotlists as $hotlist){
                File::delete('images/products/'.$hotlist->image);
                DB::table('hotlist_products')->where('id', $hotlist->id)->delete();
            }
        }

        DB::table('memberships')->where('user_id', Auth::user()->id)->delete();

        $payments = DB::table('payments')->where('user_id', Auth::user()->id)->get();
       if($payments){
        foreach($payments as $payment){
            DB::table('payments')->where('id', $payment->id)->delete();
        }
       }

        $reviews = DB::table('reviews')->where('seller_id', Auth::user()->id)->get();
        if($reviews){
            foreach($reviews as $review){
                DB::table('reviews')->where('id', $review->id)->delete();
            }
        }

        $verification = DB::table('verifications')->where('user_id', Auth::user()->id)->first();
        if($verification){
            File::delete('images/verifications/'.$verification->trade_license);
            File::delete('images/verifications/'.$verification->identification);
            DB::table('verifications')->where('user_id', Auth::user()->id)->delete();
        }

        DB::table('users')->where('id', Auth::user()->id)->delete();

        Auth::logout();
        $request->session()->flash('success', 'Account Deactivated');
        return redirect()->route('parts');

    }

    public function manageBuyerAccount()
    {
        if(Auth::check()){
            $categories = Category::where('deleted', false)->cursor();
            return view('manage_account', compact('categories'));
        }
        else{
            return redirect('login');
            return redirect()->route('parts');
        }
    }

    public function deleteBuyerAccount(Request $request){

        DB::table('users')->where('id', Auth::user()->id)->delete();

        Auth::logout();
        $request->session()->flash('success', 'Account Deactivated');
        return redirect()->route('parts');

    }
}
