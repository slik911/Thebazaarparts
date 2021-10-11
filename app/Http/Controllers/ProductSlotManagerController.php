<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProductSlotManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\NotificationModel;
class ProductSlotManagerController extends Controller
{

    public function random_strings($length_of_string)
    {

        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result),
                           0, $length_of_string);
    }

    public function index(){

        if(auth::check()){
         $new = new NotificationModel;
         $slot_data = $new->productNotification();
         return view('seller.economic_package', compact('slot_data'));
        }else{
            return redirect('login');
        }
     }

     public function saveEconomicPackage(Request $request){

        if($request->payment_reference){
            $verify_payment = (new PaystackController())->verifyTransaction( $request->payment_reference);
    
            if($verify_payment->data->status != "success"){
                $request->session()->flash('error', 'Unable to verify your payment');
            }
            else{
                $newPayment = new Payment;
                $newPayment->user_id = Auth::user()->id;
                $newPayment->payment_reference = $request->payment_reference;
                $newPayment->package = "economic";
                $newPayment->package_type = $request->package;
                $newPayment->price = $request->price;
                $newPayment->save();

                $newSlot = new ProductSlotManager;
                $newSlot->user_id = Auth::user()->id;
                $newSlot->package = $request->package;
                $newSlot->slot_id = (new ProductSlotManagerController)->random_strings(20).Auth::user()->id;
                $newSlot->start_time = Carbon::now();
                if($request->package == "Regular"){
                   $newSlot->total_slot_assigned = 5;
                   $newSlot->total_slot_remaining = 5;
                   $newSlot->end_time = carbon::now()->addDays(1);
                }
                else{
                   $newSlot->total_slot_assigned = 1;
                   $newSlot->total_slot_remaining = 1;
                    $newSlot->end_time = carbon::now()->addDays(1);
                }
                $newSlot->save();
                $request->session()->flash('success', 'Package purchased successfully');
                return redirect()->back();
            }
        }

        else{
            $request->session()->flash('success', 'Error occured while trying to make payment');
                return redirect()->back();
        }


     }


     public function manageEconomicPackage(){
        //  dd("new");
        if(auth::check()){

            $slots = DB::table('product_slot_managers')->where('user_id', Auth::user()->id)->where('end_time', '!=', null)->where('membership_reference', null)->get();

            $data   = [];
            $date = Carbon::now();
            foreach ($slots as $slot) {
               $row = [];
               $row["id"] = $slot->id;
               $row["user_id"] = $slot->user_id;
               $row["slot_id"] = $slot->slot_id;
               $row["package"] = $slot->package;
               $row["total_slot_assigned"] = $slot->total_slot_assigned;
               $row["total_slot_remaining"] = $slot->total_slot_remaining;
               $row["completed"] = $slot->completed;
               $row["end_time"] = $slot->end_time;
               $row["created_at"] = $slot->created_at;
               $row["updated_at"] = $slot->updated_at;
               $row["diffInDays"] = $date->diffInDays(Carbon::parse($slot->end_time), false);

               $data[] = $row;
            }

            $packages = json_decode(json_encode($data));
            $new = new NotificationModel;
            $data = $new->notifiable();
            $slot_data = $new->productNotification();
        return view('seller.manage_economic_package', compact('packages','data', 'slot_data'));
            }else{
                return redirect('login');
            }
     }

     public function renewEconomicPackage(Request $request){

        $newPayment = new Payment;
        $newPayment->user_id = Auth::user()->id;
        $newPayment->payment_reference = $request->payment_reference;
        $newPayment->package = "economic";
        $newPayment->package_type = $request->package;
        $newPayment->price = $request->price;
        $newPayment->save();


        if($request->package == 'Regular'){

            $data = DB::table('product_slot_managers')->where('slot_id', $request->slot_id)->first();
            DB::table('product_slot_managers')->where('slot_id', $request->slot_id)->update(['start_time' => $data->end_time, 'end_time'=> Carbon::parse($data->end_time)->addDays(1)]);

            $products = DB::table('products')->where('slot_id', $request->slot_id)->get();
            foreach($products as $product){
                DB::table('products')->where('id', $product->id)->update(['expiry_date' => Carbon::parse($data->end_time)->addDays(1)]);
            }
        }

        else if($request->package == 'Featured'){

            $data = DB::table('product_slot_managers')->where('slot_id', $request->slot_id)->first();

            DB::table('product_slot_managers')->where('slot_id', $request->slot_id)->update(['start_time' => $data->end_time, 'end_time'=> Carbon::parse($data->end_time)->addDays(1)]);

            $featured_products = DB::table('featured_products')->where('slot_id', $request->slot_id)->get();
            foreach($featured_products as $product){
                DB::table('featured_products')->where('id', $product->id)->update(['expiry_date' => Carbon::parse($data->end_time)->addDays(1)]);
            }
        }
            else{

            $data = DB::table('product_slot_managers')->where('slot_id', $request->slot_id)->first();

            DB::table('product_slot_managers')->where('slot_id', $request->slot_id)->update(['start_time' => $data->end_time, 'end_time'=> Carbon::parse($data->end_time)->addDays(1)]);

            $hotlist_products = DB::table('hotlist_products')->where('slot_id', $request->slot_id)->get();

            foreach($hotlist_products as $product){
                DB::table('hotlist_products')->where('id', $product->id)->update(['expiry_date' => Carbon::parse($data->end_time)->addDays(1)]);
            }
        }

        $request->session()->flash('success', 'Package has been renewed successfully');
         return redirect()->back();
     }



}
