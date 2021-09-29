<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\CompanyProfile;
// use App\Http\Controllers\HomeController;
use App\ProductSlotManager;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required'],
            'phone' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'role' => ['required'],
            'company_name' => 'nullable',
            'company_address' => 'nullable',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if(DB::table('users')->where('email', $data['email'])->exists()){
            Session::flash('error', 'Email has already been used by another user');
            return back();
        }
        else if(DB::table('company_profiles')->where('name', $data['company_name'])->exists()){
            Session::flash('error', 'Company name has already been used by another user');
            return back();
        }
        else{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address'=> $data['address'],
                'state_id' => $data['state'],
                'country_id' => $data['country'],
                'role'=>$data['role'],
                'password' => Hash::make($data['password']),
            ]);

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://thebazaarcommunity.com/api/create/user', [
                'form_params' => [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'address'=> $data['address'],
                    'password' => Hash::make($data['password']),
                ]
            ]);


            if($data['role'] == "seller"){

                if($data['company_name'] != null){
                    $company = new CompanyProfile;
                    $company->user_id = $user->id;
                    $company->name = $data['company_name'];
                    $company->address = $data['company_address'];
                    $company->save();
                }

                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $str = substr(str_shuffle($str_result),
                                   0, 10);
                $newSlot = new ProductSlotManager;
                $newSlot->user_id = $user->id;
                $newSlot->package = "Regular";
                $newSlot->slot_id = $str.time().$user->id;
                $newSlot->total_slot_assigned = 5;
                $newSlot->total_slot_remaining = 5;
                $newSlot->start_time = null;
                $newSlot->end_time = null;
                $newSlot->save();

            }

            return $user;
        }

    }
}
