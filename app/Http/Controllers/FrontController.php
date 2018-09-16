<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class FrontController extends Controller
{
    // Home page without search query (get)
    public function index(){
        $posts = Post::with('category')->paginate(2);
        foreach ($posts as $post) {
            $post->start_date = Carbon::parse($post->start_date)->format('d/m/Y');
            $post->end_date = Carbon::parse($post->end_date)->format('d/m/Y');
        }

        return view ('front.index', ['posts' => $posts]);
    }

    // Home page with search query (post)
    public function search(Request $request){
        $request->validate([
            'search' => 'required'
        ]);

        $query = $request->input('search');
        $posts = Post::where('title', 'LIKE', '%' . $query . '%');
        if($posts->count() > 5){
            $results = $posts->paginate(2);
        } else {
            $results = $posts->take(2)->get();
        }

        return view ('front.index', ['posts' => $results]);
    }

    // Archive stages
    public function stages(){
        $posts = Post::where('post_type', '=', 'stage')->paginate(5);

        return view ('front.archive', ['posts' => $posts, 'title' => 'Stages']);
    }

    // Archive formations
    public function formations(){
        $posts = Post::where('post_type', '=', 'formation')->paginate(5);

        return view ('front.archive', ['posts' => $posts, 'title' => 'Formations']);
    }

    // Single post
    public function show(int $id){
        $post = Post::find($id);
        $title = ($post->isFormation()) ? 'Formation' : 'Stage';
        $post->start_date = Carbon::parse($post->start_date)->format('d/m/Y');
        $post->end_date = Carbon::parse($post->end_date)->format('d/m/Y');

        return view ('front.single', ['post' => $post, 'title' => $title]);
    }

    // Contact
    public function contact(){
        return view ('front.contact');
    }

    public function sendContactMail(Request $request){
        $request->validate([
            'email' => 'bail|required|email',
            'message' => 'required',
        ]);

        $adminMail = "contact@laravelproject.com";
        $email = $request->input('email');
        $message = $request->input('message');

        Mail::to($email)->send(new ContactEmail(['email' => $email, 'message' => $message]));
        Mail::to($adminMail)->send(new ContactEmail(['email' => $email, 'message' => $message, 'admin' => true]));

        return view ('front.contact', ['sent' => true]);
    }

    // Login
    public function login()
    {
        return view ('auth.login');
    }

}