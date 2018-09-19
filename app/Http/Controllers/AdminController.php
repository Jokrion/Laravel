<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sorted = 'id', $with = 'asc')
    {
        $posts = Post::orderBy($sorted, $with)->paginate(10);

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
            'category_id' => 'required',
            'published' => 'nullable'
        ]);

        $post = new Post();
        $request->merge(['published' => ($request->input('published') == 'on') ? true : false]);
        $post->fill($request->except(['_token', 'picture']));
        $post->save();
        $image = $request->file('picture');
        if($image !== null){
            $title = $request->picture->getClientOriginalName();
            $ext = $request->picture->extension();
            $link = $request->picture->storeAs('', str_random(10) . '.' . $ext, 'public');
            $post->picture()->create([
                'title' => $title,
                'link' => $link
            ]);
        }
        
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
        $post = Post::find($id);
        $title = ($post->isFormation()) ? 'Formation' : 'Stage';

        return view ('admin.show', ['post' => $post, 'title' => $title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();

        return view ('admin.edit', ['post' => $post, 'categories' => $categories]);
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
        $validated = $request->validate([
            'picture' => 'image',
            'post_type' => 'required',
            'title' => 'bail|required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'max_students' => 'required|integer|min:0',
            'category_id' => 'required',
            'published' => 'nullable'
        ]);

        $post = Post::find($id);
        $request->merge(['published' => ($request->input('published') == 'on') ? true : false]);    
        $new_image = $request->file('picture');
        if($new_image !== null){
            $title = $request->picture->getClientOriginalName();
            $ext = $request->picture->extension();
            $link = $request->picture->storeAs('', str_random(10) . '.' . $ext, 'public');
            if($post->picture()->exists()){
                $old_picture = $post->picture->link;
                Storage::delete($old_picture);
                $post->picture()->update([
                    'title' => $title,
                    'link' => $link
                ]);
            } else {
                $post->picture()->create([
                    'title' => $title,
                    'link' => $link
                ]);
            }
        }
        $post->update($request->except(['_token', 'picture']));
        $post->save();

        return redirect('admin')->with('message', 'Le post a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('admin')->with('message', 'Le post a bien été supprimé.');
    }

    /**
     * Toggles post publication
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function togglePublish($id)
    {
        $post = Post::find($id);
        $post->published = !$post->published;
        $post->save();

        return redirect('admin')->with('message', 'La publication de ce post a été modifiée.');
    }
}
