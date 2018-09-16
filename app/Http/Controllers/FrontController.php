<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class FrontController extends Controller
{

    public function index(){
        $posts = Post::with('category')->paginate(2);
        foreach ($posts as $post) {
            $post->start_date = Carbon::parse($post->start_date)->format('d/m/Y');
            $post->end_date = Carbon::parse($post->end_date)->format('d/m/Y');
        }

        return view ('front.index', ['posts' => $posts]);
    }

    public function show(int $id){
        $post = Post::find($id);

        return view ('front.show', ['post' => $post]);
    }

    public function search(Request $request){
        $query = $request->input('search');
        $posts = Post::where('title', 'LIKE', '%' . $query . '%');
        if($posts->count() > 5){
            $results = $posts->paginate(2);
        } else {
            $results = $posts->take(2)->get();
        }

        return view ('front.index', ['posts' => $results]);
    }

}