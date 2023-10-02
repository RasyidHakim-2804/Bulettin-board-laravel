<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Jobs\ProcessRegistration;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    //auth view
    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }


    //controller for action
    public function register(Request $request)
    {
        $account = $request->validate([
            'user_name' => 'required|unique:users,user_name',
            'password'  => 'required',
            'email'     => 'required|unique:users,email|email',
        ]);

        $user = new User();
        $user->user_name = $account['user_name'];
        $user->password  = $account['password'];
        $user->email     = $account['email'];
        $user->save();

        event(new Registered($user));
        // ProcessRegistration::dispatch($user);
        
        Auth::login($user);
        return redirect()->route('verification.notice');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required',
            'password'  => 'required',
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/post');
        }

        return back()->withErrors('Your account is not authenticated,  please fill carefully')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('login');
    }
}
