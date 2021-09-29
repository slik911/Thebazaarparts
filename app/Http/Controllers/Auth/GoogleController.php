<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();


        try {

            $user = Socialite::driver('google')->stateless()->user();

            // dd($user);
            // $finduser = User::where('google_id', $user->id)->first();
            if(DB::table('user')->where('email', $user->email)->exists()){
                $request->session()->flash('error', 'Email already exists, try logging in directly');
                return redirect()->back();
            }
            else{
                if(User::where('google_Id', $user->id)->exists()){
                    $finduser = User::where('google_id', $user->id)->first();
                    Auth::login($finduser);

                    return redirect('/home');
                }
                else{
                    $new = new User;
                    $new->name = $user->name;
                    $new->email = $user->email;
                    $new->google_id = $user->id;
                    $new->email_verified_at = Carbon::now();
                    $new->password = encrypt('123456dummy');
                    $new->save();
                    Auth::login($new);

                    return redirect('/home');
                }
            }


        } catch (Exception $e) {
            dd($e);
            $request->session()->flash('error', 'sorry an error just occured! please try again later.');
            return redirect()->back();
        }
    }
}
