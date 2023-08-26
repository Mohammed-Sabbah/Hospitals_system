<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{


    public function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember' => 'in:on'
        ]);

        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if (Auth::attempt($credentials, $request->get('remember'))) {
            return redirect()->route('front.home');
        } else {
            return redirect()->back();
        }
    }



    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }






    public function handelGoogleCallback(){
        $user = Socialite::driver('google')->user();

        $findUser = User::where('social_id' , $user->id)->first();

        if($findUser){
            Auth::login($findUser);
            return redirect()->route('front.home');
        }
        else{
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->social_id = $user->id;
            $newUser->social_type = 'google';
            $newUser->password = Hash::make('my-google');

            $newUser->save();

            Auth::login($newUser);
            return redirect()->route('front.home');
        }
    }


    public function handelFacebookCallback(){
        $user = Socialite::driver('facebook')->user();

        $findUser = User::where('social_id' , $user->id)->first();

        if($findUser){
            Auth::login($findUser);
            return redirect()->route('front.home');
        }
        else{
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->social_id = $user->id;
            $newUser->social_type = 'facebook';
            $newUser->password = Hash::make('my-facebook');

            $newUser->save();

            Auth::login($newUser);
            return redirect()->route('front.home');
        }
    }
}
