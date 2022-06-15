<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show Register/Create Form
    public function create(){
        return view('users.register');
    }
    //create  New User
    public function store(Request $request){
        $formFields=$request->validate([
            'name'=>['required','min:10','max:30'],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>['required', 'min:6', 'confirmed'],
        ]);

        //Hash Password
        $formFields['password']=bcrypt($formFields['password']);

        //create user
        $user=User::create($formFields);

        //login
        auth()->login($user);
        return redirect('/')->with('message', 'user created and logged in');
    }

    //log user out
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'user You have been logged out!');
    }

    //show login form
    public function login(){
        return view('users.login');
    }

    //authenticate user
    public function authenticate(Request $request){
        $formFields=$request->validate([
            'email'=>['required','email'],
            'password'=>'required',
        ]);
        if (auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','Yuou are now logged in!');
        }
        return back()->withErrors(['email'=>'invalid credentials'])->onlyInput('email');
    }
}
