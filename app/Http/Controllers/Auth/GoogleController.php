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
        if(DB::table('users')->where('google_id', null)->where('email', $user->email)->exists()){
            $request->session()->flash('error', 'Account was registered via another mean, try to login directly');
            return redirect()->route('login');
        }
        else{
            // dd('ok');
            try {

                $user = Socialite::driver('google')->stateless()->user();

                $finduser = User::where('google_id', $user->id)->first();

                if($finduser){

                    Auth::login($finduser);

                    return redirect('/home');

                }else{

                    $new = new User;
                    $new->name = $user->name;
                    $new->email = $user->email;
                    $new->google_id = $user->id;
                    $new->email_verified_at = Carbon::now();
                    $new->password = encrypt('Thebazaarparts@2021');
                    $new->save();
                    Auth::login($new);

                    return redirect('/home');
                }

            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }

    }
 
}
