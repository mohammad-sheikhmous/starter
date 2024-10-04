<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Model\User;

class SocialAuthController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service)
    {
        try {
            // $facebookUser = Socialite::driver('facebook')->stateless()->user();
            // $serviceUser = Socialite::with($service)->user();
            $serviceUser = Socialite::driver($service)->user();

            $user = User::where('facebook_id',$serviceUser->id)->first();


            if($user){
                // If the user already exists, log them in
                Auth::login($user);
            }else{
                // Otherwise, create a new user and log them in
                $user =User::create([
                    'name'=> $serviceUser->name,
                    'email'=> $serviceUser->email,
                    'facebook_id'=> $serviceUser->id,
                ]);

                Auth::login($user);
            }

            return redirect()->intended('home');
        }catch(Exception $ex){
            return redirect('login')->withErrors(['error' => 'Unable to login with Facebook. Please try again.']);
        }
    }

}
