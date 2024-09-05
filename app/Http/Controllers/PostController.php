<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * converting title to slug 
     */
    public function slugify(string $name)
    {
        return strtolower(str_replace(' ', '_', $name));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|max:100',
            'body' => 'required'
        ]);

        $slug = $this->slugify($fields['title']);
        $post = array_merge($fields, ['slug' => $slug]);

        Post::create($post);
        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $fields = $request->validate([
            'title' => 'required|max:100',
            'body' => 'required'
        ]);

        $slug = $this->slugify($fields['title']);
        $new_post = array_merge($fields, ['slug' => $slug]);

        $post->update($new_post);
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return "deleted";
    }
}
