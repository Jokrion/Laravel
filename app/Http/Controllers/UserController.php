<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

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

    public function showProfile()
    {

        return view ('auth.profile');
    }
}
