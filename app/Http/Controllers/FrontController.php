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
        $posts = Post::orderBy('start_date', 'desc')
            ->where('published', 1)
            ->where('end_date', '>', Carbon::now())
            ->take(2)
            ->get();

        return view ('front.index', ['posts' => $posts]);
    }

    // Home page with search query (post)
    public function search(Request $request){
        $request->validate([
            'search' => 'required'
        ]);

        $query = $request->input('search');
        $posts = Post::orderBy('start_date', 'desc')
            ->where('published', 1)
            ->where('title', 'LIKE', '%' . $query . '%');
        $results = $posts->paginate(5);

        return view ('front.index', ['posts' => $results]);
    }

    // Archive stages
    public function stages(){
        $posts = Post::orderBy('start_date', 'desc')
            ->where('published', 1)
            ->where('post_type', 'stage')
            ->paginate(5);

        return view ('front.archive', ['posts' => $posts, 'title' => 'Stages', 'type' => 'stage']);
    }

    // Archive pages with search query (post)
    public function searchArchive(Request $request)
    {
        $request->validate([
            'search' => 'required',
            'type' => 'required'
        ]);

        $query = $request->input('search');
        $type = $request->input('type');
        $posts = Post::orderBy('start_date', 'desc')
            ->where('published', 1)
            ->where('post_type', $type)
            ->where('title', 'LIKE', '%' . $query . '%');
        $results = $posts->paginate(5);

        ($type == 'stage') ? $title = 'Stages' : $title = 'Formations';

        return view ('front.archive', ['posts' => $results, 'title' => $title, 'type' => $type]);
    }

    // Archive formations
    public function formations(){
        $posts = Post::orderBy('start_date', 'desc')
            ->where('published', 1)
            ->where('post_type', 'formation')
            ->paginate(5);

        return view ('front.archive', ['posts' => $posts, 'title' => 'Formations', 'type' => 'formation']);
    }

    // Single post
    public function show(int $id){
        $post = Post::find($id);
        if(!$post->published) return redirect('')->with('message', 'Ce post n\'est pas disponible.');
        $title = ($post->isFormation()) ? 'Formation' : 'Stage';

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

}