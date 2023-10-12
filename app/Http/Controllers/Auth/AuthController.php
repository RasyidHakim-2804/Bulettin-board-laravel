<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;

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
    public function register(RegisterRequest $request)
    {
        $account = $request->validated();

        $user = new User();
        $user->fill($account);
        $user->save();

        event(new Registered($user));
        // ProcessRegistration::dispatch($user);
        
        Auth::login($user);
        return redirect()->route('verification.notice');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()
        ->withErrors('Your account is not authenticated,  please fill carefully')
        ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('login');
    }

}
