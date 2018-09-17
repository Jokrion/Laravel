<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Login
    public function login()
    {
        return view ('auth.login');
    }

    // Logout
    public function logout()
    {
    	Auth::logout();
  		return redirect('/');
    }
}
