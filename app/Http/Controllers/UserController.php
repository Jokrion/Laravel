<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

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

    public function participate($post_id)
    {
        if(!Auth::check()) {
            return redirect('home')->with('message', 'Vous n\'êtes pas connecté.');
        } else {
            $id = Auth::user()->id;
            $user = User::findOrFail($id);

            $user->posts()->attach($post_id);
        }

        return redirect()->back()->with('message', 'Vous êtes désormais inscrit à cet événement.');
    }

    public function unparticipate($post_id)
    {
        if(!Auth::check()) {
            return redirect('home')->with('message', 'Vous n\'êtes pas connecté.');
        } else {
            $id = Auth::user()->id;
            $user = User::findOrFail($id);

            $user->posts()->detach($post_id);
        }

        return redirect()->back()->with('message', 'Vous ne participez plus à cet événement.');
    }

    public function showProfile()
    {
        if(!Auth::check()) {
            return redirect('home')->with('message', 'Vous n\'êtes pas connecté.');
        } else {
            $id = Auth::user()->id;
            $user = User::findOrFail($id);
            $posts = $user->posts()->paginate(10);
            return view ('auth.profile', ['posts' => $posts]);
        }
    }
}
