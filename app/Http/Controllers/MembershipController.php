<?php

namespace App\Http\Controllers;

use App\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Payment;
use App\ProductSlotManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\NotificationModel;

class MembershipController extends Controller
{
    public function random_strings($length_of_string)
    {

        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result),
                           0, $length_of_string);
    }

    public function membershipIndex(){

        if(auth::check()){
         $new = new NotificationModel;
         $slot_data = $new->productNotification();
         $profile_verification = DB::table('company_profiles')->where('user_id', Auth::user()->id)->first();
         $verification = DB::table('verifications')->where('user_id', Auth::user()->id)->first();
         return view('seller.membership_package', compact('slot_data', 'profile_verification', 'verification'));
        }else{
            return redirect('login');
        }
     }

     public function saveMembershipPackage(Request $request){
        if($request->payment_reference){
            $verify_payment = (new PaystackController())->verifyTransaction($request->payment_reference);
            if($verify_payment->data->status != "success"){
                $request->session()->flash('error', 'Unable to verify your payment');
            }
            else{
                $newPayment = new Payment;
                $newPayment->user_id = Auth::user()->id;
                $newPayment->payment_reference = $request->payment_reference;
                $newPayment->package = "membership";
                $newPayment->package_type = $request->package;
                $newPayment->price = $request->price;
                if($request->package == 'Silver'){
                   $newPayment->expiry_date = Carbon::now()->addDays(1);
                }
                if($request->package == 'Gold'){
                    $newPayment->expiry_date = Carbon::now()->addDays(1);
                }
                if($request->package == 'Platinum'){
                    $newPayment->expiry_date = Carbon::now()->addDays(1);
                }
                    $newPayment->save();

                if($request->package == "Silver"){
                    $newSlot = new ProductSlotManager;
                    $newSlot->membership_reference = $request->payment_reference;
                    $newSlot->user_id = Auth::user()->id;
                    $newSlot->package = "Regular";
                    $newSlot->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                    $newSlot->total_slot_assigned = 25;
                    $newSlot->total_slot_remaining = 25;
                    $newSlot->start_time = Carbon::now();
                    $newSlot->end_time = carbon::now()->addDays(1);
                    $newSlot->save();

                    $newSlot2 = new ProductSlotManager;
                    $newSlot2->user_id = Auth::user()->id;
                    $newSlot2->membership_reference = $request->payment_reference;
                    $newSlot2->package = "Hotlist";
                    $newSlot2->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                    $newSlot2->total_slot_assigned = 1;
                    $newSlot2->total_slot_remaining = 1;
                    $newSlot2->start_time = Carbon::now();
                    $newSlot2->end_time = carbon::now()->addDays(1);;
                    $newSlot2->save();
                }

                if($request->package == "Gold"){
                    $newSlot = new ProductSlotManager;
                    $newSlot->membership_reference = $request->payment_reference;
                    $newSlot->user_id = Auth::user()->id;
                    $newSlot->package = "Regular";
                    $newSlot->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                    $newSlot->total_slot_assigned = 35;
                    $newSlot->total_slot_remaining = 35;
                    $newSlot->start_time = Carbon::now();
                    $newSlot->end_time = carbon::now()->addDays(1);
                    $newSlot->save();

                    $newSlot2 = new ProductSlotManager;
                    $newSlot2->user_id = Auth::user()->id;
                    $newSlot2->membership_reference = $request->payment_reference;
                    $newSlot2->package = "Hotlist";
                    $newSlot2->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                    $newSlot2->total_slot_assigned = 2;
                    $newSlot2->total_slot_remaining = 2;
                    $newSlot2->start_time = Carbon::now();
                    $newSlot2->end_time = carbon::now()->addDays(1);
                    $newSlot2->save();

                    $newSlot3 = new ProductSlotManager;
                    $newSlot3->user_id = Auth::user()->id;
                    $newSlot3->membership_reference = $request->payment_reference;
                    $newSlot3->package = "Featured";
                    $newSlot3->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                    $newSlot3->total_slot_assigned = 1;
                    $newSlot3->total_slot_remaining = 1;
                    $newSlot3->start_time = Carbon::now();
                    $newSlot3->end_time = carbon::now()->addDays(1);
                    $newSlot3->save();
                }

                if($request->package == "Platinum"){
                    $newSlot = new ProductSlotManager;
                    $newSlot->user_id = Auth::user()->id;
                    $newSlot->membership_reference = $request->payment_reference;
                    $newSlot->package = "Regular";
                    $newSlot->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                    $newSlot->total_slot_assigned = 45;
                    $newSlot->total_slot_remaining = 45;
                    $newSlot->start_time = Carbon::now();
                    $newSlot->end_time = carbon::now()->addDays(1);
                    $newSlot->save();

                    $newSlot2 = new ProductSlotManager;
                    $newSlot2->user_id =    Auth::user()->id;
                    $newSlot2->package = "Hotlist";
                    $newSlot2->membership_reference = $request->payment_reference;
                    $newSlot2->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                    $newSlot2->total_slot_assigned = 3;
                    $newSlot2->total_slot_remaining = 3;
                    $newSlot2->start_time = Carbon::now();
                    $newSlot2->end_time = carbon::now()->addDays(1);
                    $newSlot2->save();

                    $newSlot3 = new ProductSlotManager;
                    $newSlot3->user_id = Auth::user()->id;
                    $newSlot3->membership_reference = $request->payment_reference;
                    $newSlot3->package = "Featured";
                    $newSlot3->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                    $newSlot3->total_slot_assigned = 2;
                    $newSlot3->total_slot_remaining = 2;
                    $newSlot3->start_time = Carbon::now();
                    $newSlot3->end_time = carbon::now()->addDays(1);
                    $newSlot3->save();
                }


                $company = DB::table('company_profiles')->where('user_id', Auth::user()->id)->first();


                if(DB::table('memberships')->where('user_id', Auth::user()->id)->exists()){
                    $data = DB::table('memberships')->where('user_id', Auth::user()->id)->first();

                    if($request->package == 'Silver'){
                        DB::table('memberships')->where('user_id', Auth::user()->id)->update([
                            'silver'=>true,
                            'silver_expiry_date'=> Carbon::parse($data->silver_expiry_date)->addDays(1),
                        ]);
                    }
                    if($request->package == 'Gold'){
                        DB::table('memberships')->where('user_id', Auth::user()->id)->update([
                            'gold'=>true,
                            'gold_expiry_date'=> Carbon::parse($data->gold_expiry_date)->addDays(1),
                        ]);
                    }
                    if($request->package == 'Platinum'){
                        DB::table('memberships')->where('user_id', Auth::user()->id)->update([
                            'platinum'=>true,
                            'platinum_expiry_date'=> Carbon::parse($data->platinum_expiry_date)->addDays(1),
                        ]);

                    }
                }
                else{
                    $member = new Membership;
                    $member->user_id = Auth::user()->id;
                    $member->company_id = $company->id;
                    if($request->package == 'Silver'){
                        $member->silver = true;
                        $member->silver_expiry_date = carbon::now()->addDays(1);
                    }
                    if($request->package == 'Gold'){
                        $member->gold = true;
                        $member->gold_expiry_date = carbon::now()->addDays(1);
                    }
                    if($request->package == 'Platinum'){
                        $member->platinum = true;
                        $member->platinum_expiry_date = carbon::now()->addDays(1);
                    }
                    $member->save();
                }
                $request->session()->flash('success', 'Package purchased successfully');
                return redirect()->back();
            }
        }
        else{

        }


    }

    public function manageMembershipPackage(){
          if(auth::check()){
             $new = new NotificationModel;
             $slot_data = $new->productNotification();
            $memberships = DB::table('payments')->where('user_id', Auth::user()->id)->where('package', 'membership')->where('expiry_date', '!=', null)->where('deleted', false)->get();

            $data   = [];
            $date = Carbon::now();
            foreach ($memberships as $membership) {
               $row = [];
               $row["id"] = $membership->id;
               $row["user_id"] = $membership->user_id;
               $row["payment_reference"] = $membership->payment_reference;
               $row["package"] = $membership->package;
               $row["package_type"] = $membership->package_type;
               $row["price"] = $membership->price;
               $row["expiry_date"] = $membership->expiry_date;
               $row["created_at"] = $membership->created_at;
               $row["diffInDays"] = $date->diffInDays(Carbon::parse($membership->expiry_date), false);

               $data[] = $row;
            }

            $packages = json_decode(json_encode($data));

            // dd($packages);


             return view('seller.manage_membership_package', compact('packages', 'slot_data'));
            }else{
                return redirect('login');
            }
    }


    public function renewMembershipPackage(Request $request){
        $newPayment = new Payment;
        $newPayment->user_id = Auth::user()->id;
        $newPayment->payment_reference = $request->payment_reference;
        $newPayment->package = "membership renewal";
        $newPayment->package_type = $request->package_type;
        $newPayment->price = $request->price;
        $newPayment->save();

        $data = DB::table('payments')->where('id', $request->id)->first();

        if(DB::table('product_slot_managers')->where('membership_reference', $request->old_reference)->exists()){

            if($request->package_type == "Silver"){
                DB::table('product_slot_managers')->where('membership_reference', $request->old_reference)->where('package', 'Regular')->update([
                    "expiry_notification"=>false,
                    "start_time" => Carbon::parse($data->expiry_date),
                    "end_time" =>Carbon::parse($data->expiry_date)->addDays(1),
                ]);
                $slot = DB::table('product_slot_managers')->where('membership_reference', $request->old_reference)->where('package', 'Regular')->first();
                $products = DB::table('products')->where('slot_id', $slot->slot_id)->get();
                foreach($products as $product){
                    DB::table('products')->where('id', $product->id)->update([
                        "expiry_date" => Carbon::parse($data->expiry_date)->addDays(1),
                    ]);
                }
            }

            if($data->package_type == "Gold"){
                DB::table('product_slot_managers')->where('membership_reference', $request->old_reference)->where('package', 'Regular')->update([
                    "expiry_notification"=>false,
                    "start_time" => Carbon::parse($data->expiry_date),
                    "end_time" =>Carbon::parse($data->expiry_date)->addDays(1),
                ]);
                $slot = DB::table('product_slot_managers')->where('membership_reference', $request->old_reference)->where('package', 'Regular')->first();
                $products = DB::table('products')->where('slot_id', $slot->slot_id)->get();
                foreach($products as $product){
                    DB::table('products')->where('id', $product->id)->update([
                        "expiry_date" => Carbon::parse($data->expiry_date)->addDays(1),
                    ]);
                }
            }

            if($data->package_type == "Platinum"){
                DB::table('product_slot_managers')->where('membership_reference', $request->old_reference)->where('package', 'Regular')->update([
                    "expiry_notification"=>false,
                    "start_time" => Carbon::parse($data->expiry_date),
                    "end_time" =>Carbon::parse($data->expiry_date)->addDays(1),
                ]);

                $slot = DB::table('product_slot_managers')->where('membership_reference', $request->old_reference)->where('package', 'Regular')->first();
                $products = DB::table('products')->where('slot_id', $slot->slot_id)->get();
                foreach($products as $product){
                    DB::table('products')->where('id', $product->id)->update([
                        "expiry_date" => Carbon::parse($data->expiry_date)->addDays(1),
                    ]);
                }
            }

            if($request->package_type == "Silver"){

                $newSlot2 = new ProductSlotManager;
                $newSlot2->user_id = Auth::user()->id;
                $newSlot2->membership_reference = $request->old_reference;
                $newSlot2->package = "Hotlist";
                $newSlot2->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                $newSlot2->total_slot_assigned = 1;
                $newSlot2->total_slot_remaining = 1;
                $newSlot2->start_time = Carbon::parse($data->expiry_date);
                $newSlot2->end_time = Carbon::parse($data->expiry_date)->addDays(1);
                $newSlot2->save();
            }

            if($request->package_type == "Gold"){


                $newSlot2 = new ProductSlotManager;
                $newSlot2->user_id = Auth::user()->id;
                $newSlot2->membership_reference = $request->old_reference;
                $newSlot2->package = "Hotlist";
                $newSlot2->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                $newSlot2->total_slot_assigned = 2;
                $newSlot2->total_slot_remaining = 2;
                $newSlot2->start_time = Carbon::parse($data->expiry_date);
                $newSlot2->end_time = Carbon::parse($data->expiry_date)->addDays(1);
                $newSlot2->save();

                $newSlot3 = new ProductSlotManager;
                $newSlot3->user_id = Auth::user()->id;
                $newSlot3->membership_reference = $request->old_reference;
                $newSlot3->package = "Featured";
                $newSlot3->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                $newSlot3->total_slot_assigned = 1;
                $newSlot3->total_slot_remaining = 1;
                $newSlot3->start_time = Carbon::parse($data->expiry_date);
                $newSlot3->end_time = Carbon::parse($data->expiry_date)->addDays(1);
                $newSlot3->save();
            }

            if($request->package_type == "Platinum"){

                $newSlot2 = new ProductSlotManager;
                $newSlot2->user_id =    Auth::user()->id;
                $newSlot2->package = "Hotlist";
                $newSlot2->membership_reference = $request->old_reference;
                $newSlot2->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                $newSlot2->total_slot_assigned = 3;
                $newSlot2->total_slot_remaining = 3;
                $newSlot2->start_time = Carbon::parse($data->expiry_date);
                $newSlot2->end_time = Carbon::parse($data->expiry_date)->addDays(1);
                $newSlot2->save();

                $newSlot3 = new ProductSlotManager;
                $newSlot3->user_id = Auth::user()->id;
                $newSlot3->membership_reference = $request->old_reference;
                $newSlot3->package = "Featured";
                $newSlot3->slot_id = (new MembershipController)->random_strings(20).Auth::user()->id;
                $newSlot3->total_slot_assigned = 2;
                $newSlot3->total_slot_remaining = 2;
                $newSlot3->start_time = Carbon::parse($data->expiry_date);
                $newSlot3->end_time = Carbon::parse($data->expiry_date)->addDays(1);
                $newSlot3->save();
            }

            if($request->package_type == 'Silver'){
                DB::table('memberships')->where('user_id', Auth::user()->id)->update([
                    'silver'=>true,
                    'silver_expiry_date'=> Carbon::parse($data->expiry_date)->addDays(1),
                ]);
            }
            if($request->package_type == 'Gold'){
                DB::table('memberships')->where('user_id', Auth::user()->id)->update([
                    'gold'=>true,
                    'gold_expiry_date'=> Carbon::parse($data->expiry_date)->addDays(1),
                ]);
            }
            if($request->package_type == 'Platinum'){
                DB::table('memberships')->where('user_id', Auth::user()->id)->update([
                    'platinum'=>true,
                    'platinum_expiry_date'=> Carbon::parse($data->expiry_date)->addDays(1),
                ]);

            }

             DB::table('payments')->where('id', $request->id)->update([
                "expiry_date" => Carbon::parse($data->expiry_date)->addDays(1),
             ]);

             $request->session()->flash('success', 'Package renewed successfully');
             return redirect()->back();
        }

    }
}
