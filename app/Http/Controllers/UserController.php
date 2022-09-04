<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create Form

    public function create()
    {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'], //atleast 3 characters
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create the user and automatically log in
        $user = User::create($formFields); //create the user

        //Login
        auth()->login($user);

        //redirect
        return redirect('/')->with('message', 'User created and logged in');

    }

    //Logout User
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }


    // Show Login Form
    public function login()
    {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);   

        if(auth()->attempt($formFields)){
            $request->sessio()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        // else ie if fail
        return back()->withErrors(['email' => 'Invalid username and/or password'])->onlyInput('email');
    }

}
