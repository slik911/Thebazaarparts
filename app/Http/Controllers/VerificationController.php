<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Verification;
use App\Membership;
use App\Jobs\VerificationMail as JobsVerificationMail;
use Illuminate\Support\Facades\File;
use App\NotificationModel;

class VerificationController extends Controller
{

    public function random_strings($length_of_string) 
    { 
      
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
        return substr(str_shuffle($str_result),  
                           0, $length_of_string); 
    } 

    public function index(){
        if(Auth::check()){
            $data = DB::table('verifications')->where('user_id', auth::user()->id)->first();
            $new = new NotificationModel;
            $slot_data = $new->productNotification();
            return view('seller.verification', compact('data', 'slot_data'));
        }
        else{
            return redirect('login');
        }
    }

    public function upload(Request $request){
        if(DB::table('verifications')->where('user_id', auth::user()->id)->exists()){
            $request->session()->flash('error', 'Data has already been uploaded');
            return redirect()->back();
        }
        else{
            $company_id = DB::table('company_profiles')->where('user_id', auth::user()->id)->first();

            if($company_id == null){
                $request->session()->flash('error', 'Please update your company profile before verification');
                return redirect()->route('seller.profile');
            }
            else{
                $new = new Verification;
                $new->user_id = auth::user()->id;
              
                $new->company_id = $company_id->id;
                $fileName1 = (new VerificationController)->random_strings(10).Auth::user()->id.'.'.$request->trade_license->getClientOriginalExtension();

                $request->trade_license->move(public_path('/images/verifications'), $fileName1);
                $new->trade_license = $fileName1;
            
    
    
                $fileName2 = (new VerificationController)->random_strings(10).Auth::user()->id.'.'.$request->id_card->getClientOriginalExtension();

                $request->id_card->move(public_path('/images/verifications'), $fileName2);
                $new->identification = $fileName2;
                
                $new->save();
                $request->session()->flash('success', 'Verification form uploaded successfully');
                return redirect()->route('verification.index');
            }
        }
    }

    public function manage(){
        if(Auth::check()){
            $details = DB::table('verifications')
                    ->select('verifications.*', 'users.name as name', 'company_profiles.name as company_name')
                    ->leftJoin('users', 'users.id', '=', 'verifications.user_id')
                    ->leftJoin('company_profiles', 'company_profiles.id', '=', 'verifications.company_id')
                    ->latest()->cursor();
                    $new = new NotificationModel;
                    $data = $new->notifiable();
            return view('admin.VerificationManager', compact('details', 'data'));
        }
        else{
            return redirect('login');
        }
    }

    public function approve(Request $request){
        $data = DB::table('verifications')
                        ->select('verifications.*', 'users.email as email')
                        ->leftJoin('users', 'users.id', '=', 'verifications.user_id')
                        ->where('verifications.id', $request->id)->first();

        DB::table('verifications')->where('id', $request->id)->update(['status'=>true]);

        $company = DB::table('company_profiles')->where('user_id', $data->user_id)->first();

        if( DB::table('memberships')->where('user_id', $data->user_id)->where('company_id', $data->company_id)->exists()){
            DB::table('memberships')->where('user_id', $data->user_id)->where('company_id', $data->company_id)->update(['verified'=> true]);
        }
        else{
            $member = new Membership;
            $member->user_id = $data->user_id;
            $member->company_id = $company->id;
            $member->verified = true;
            $member->save();
        }
        

        $details =[
            'title' => 'Verification Confirmation',
            'url' => route('home'),
            'stat' => 'Congratulations',
            'text' => 'This is to inform you that your request for verification has been successfully approved. You can now procced to your dashboard to continue other activities',
      
        ];


        $email = $data->email;

        JobsVerificationMail::dispatch($details, $email)
                ->delay(now()->addSeconds(10));
        // Mail::to($data->email)->send(new VerificationMail($details));

        $request->session()->flash('success', 'Verification approved');
        return redirect()->back();
    }

    public function reject(Request $request){
        $data = DB::table('verifications')
                        ->select('verifications.*', 'users.email as email')
                        ->leftJoin('users', 'users.id', '=', 'verifications.user_id')
                        ->where('verifications.id', $request->id)->first();

                

        $details =[
            'title' => 'Verification Declined',
            'url' => route('home'),
            'stat' => '',
            'text' => 'We are sorry to inform you that your verification has been declined. Please contact support for more information',
      
        ];
        $email = $data->email;

        JobsVerificationMail::dispatch($details, $email)
                ->delay(now()->addSeconds(10));
               
        File::delete('images/verifications/'.$data->trade_license);
        File::delete('images/verifications/'.$data->identification);
        DB::table('verifications')->where('id', $request->id)->delete();

        $request->session()->flash('success', 'Verification desclined successfully');
            return redirect()->back();
    }
}
