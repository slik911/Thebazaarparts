<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\NotificationModel;
class PaymentController extends Controller
{
    public function index(){
        if(Auth::check()){
            $payments = DB::table('payments')
                        ->select('payments.*', 'users.name as user_name', 'users.email as user_email')
                        ->leftJoin('users', 'users.id', '=', 'payments.user_id')
                        ->orderByDesc('payments.updated_at')->where('payments.deleted', false)->cursor();
                        $new = new NotificationModel;
                        $data = $new->notifiable();
                   
                        return view('admin.payments', compact('payments', 'data'));
            
        }
        else{
            return redirect('login');
        }
    }

    public function refund(Request $request){
        DB::table('payments')->where('id', $request->id)->update(['refunded'=>true]);
        $request->session()->flash('success', 'Payment refunded successfully');
        return redirect()->back();
    }

    public function delete(Request $request){
        DB::table('payments')->where('id', $request->id)->update(['deleted'=>true]);
        $request->session()->flash('success', 'Payment deleted successfully');
        return redirect()->back();
    }

    public function history(){
        $payments = DB::table('payments')->where('user_id', Auth::user()->id)->orderByDesc('updated_at')->cursor();
        $new = new NotificationModel;
        $slot_data = $new->productNotification(); 
        // dd($payments);
        return view('seller.payment_history', compact('payments', 'slot_data'));
    }
}
