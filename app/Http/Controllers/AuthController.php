<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember' => 'in:on'
        ]);

        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if (Auth::guard('admin')->attempt($credentials, $request->get('remember'))) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }

    public function changePassword(){
        return view('admin.auth.change-password');
    }

    public function postChangePassword(Request $request){
        $request->validate([
            'password'=>'required|current_password:admin',
            'new_password'=>'required|string|confirmed'
        ]);

        $user = auth()->user();
        // $user = auth()->id();
        // $user = Auth::user();

        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return redirect()->route('admin.home');
    }
}
