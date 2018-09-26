<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
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
    public function index()
    {
        $posts = Post::paginate(10);

        return view ('admin.index', ['posts' => $posts]);
    }

    // Admin panel with query results (post) - Search bar or sort
    public function searchOrSort(Request $request)
    {
        $type = $request->input('type');
        if($type == null) $type = 'search';
        if($type == 'search'){
            $request->validate([
                'search' => 'required'
            ]);

            $query = $request->input('search');
            $posts = Post::where('title', 'LIKE', '%' . $query . '%')->paginate(10);
        } else {
            $field = $request->input('field');
            if($field == null) $field = 'title';
            $direction = $request->input('direction');
            if($direction == null) $direction = 'asc';
            $posts = Post::orderBy($field, $direction)->paginate(10);
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
    public function store(PostRequest $request)
    {
        $validated = $request->validated();

        $post = new Post();
        $request->merge(['status' => ($request->input('status') == 'on') ? 'published' : 'draft']);
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
        
        return redirect('admin')->with('message', 'L\'événement a bien été créé.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
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
        $post = Post::findOrFail($id);
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
    public function update(PostRequest $request, $id)
    {
        $validated = $request->validated();

        $post = Post::findOrFail($id);
        $request->merge(['status' => ($request->input('status') == 'on') ? 'published' : 'draft']);    
        $new_image = $request->file('picture');
        if($new_image !== null){
            $title = $request->picture->getClientOriginalName();
            $ext = $request->picture->extension();
            $link = $request->picture->storeAs('', str_random(10) . '.' . $ext, 'public');
            if($post->picture()->exists()){
                $old_picture = $post->picture->link;
                Storage::disk('public')->delete($old_picture);
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

        return redirect('admin')->with('message', 'L\'événement a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->picture()->exists()){
            Storage::disk('public')->delete($post->picture->link);
        }
        $post->delete();

        return redirect('admin')->with('message', 'L\'événement a bien été supprimé.');
    }

    /**
     * Toggles post publication
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function togglePublish($id)
    {
        $post = Post::findOrFail($id);
        $post->status = ($post->status == 'draft') ? 'published' : 'draft';
        $post->save();

        return redirect('admin')->with('message', 'La publication de cet événement a été modifiée.');
    }

    /**
     * Triggers action from ajax call (grouped actions)
     *
     * @param  int  $id
     * @param string $method
     */
    public function adminAction($id, $method)
    {
        $post = Post::findOrFail($id);

        if($method == 'del') {
            if($post->picture()->exists()){
                Storage::disk('public')->delete($post->picture->link);
            }
            $post->delete();
        }

        if($method == 'soft') {

        }
    }
}
