<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Carbon\Carbon;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        foreach ($posts as $post) {
            $post->start_date = Carbon::parse($post->start_date)->format('d/m/Y');
            $post->end_date = Carbon::parse($post->end_date)->format('d/m/Y');
        }

        return view ('admin.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();

        return view ('admin.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'picture' => 'image',
            'post_type' => 'required',
            'title' => 'bail|required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'max_students' => 'required|integer|min:0',
            'category' => 'required',
            'published' => 'nullable'
        ]);

        $post = new Post();
        $post->post_type = $request->input('post_type');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->start_date = $request->input('start_date');
        $post->end_date = $request->input('end_date');
        $post->price = $request->input('price');
        $post->max_students = $request->input('max_students');
        $cat = Category::find($request->input('category'));
        $post->category()->associate($cat);
        $post->published = ($request->input('published') == 'on') ? true : false;
        if($request->input('image') !== null){
            $link = str_random(12) . '.jpg';
            $file = $request->input('image');
            Storage::disk('public')->put($link, $file);
            $post->picture()->create([
                'title' => $post->title,
                'link' => $link
            ]);
        }
        $post->save();

        return redirect('admin')->with('message', 'Le post a bien été créé.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
