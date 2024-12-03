<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logout() {
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out');
    }
    public function viewcorrectHomepage(){
        
        if (auth()->check()) {
            return view('homepage-feed');
        }
        else{
            return view('homepage');
        }
    }
    public function login(Request $request){
        $incomingdata = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['username' => $incomingdata['loginusername'], 'password' => $incomingdata['loginpassword']])) {

            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are now logged in');
        }
        else{
            return redirect('/')->with('fail', 'Incorrect login details');
        }
    }
    public function register (Request $request) {

        //validate the resuest data
        $incomingData = $request->validate([
            'username' => ['required', 'min: 3', 'max: 10', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min: 6', 'confirmed']
        ]);

        //save the resuest data in db
        $user = User::create($incomingData);
        auth()->login($user);

        return redirect('/')->with('success', 'Thank you for registering');
    }
}
