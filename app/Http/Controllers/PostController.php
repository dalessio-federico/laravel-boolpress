<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        $data = [
            'posts' => $post
        ];
        return view('post', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            "title"=> "required|unique:posts|max:50",
            "content"=> "required|string",
        ]);

        $newPost = new Post;

        $newPost->fill($data);

        $slug = Str::slug($newPost->title, '-');
            $slugBase = $slug;
            $existingPost = Post::where('slug', $slug)->first();
            $counter = 1;
            while($existingPost) {
                $slug = $slugBase . '-' . $counter;
                $counter++;
                $existingPost = Post::where('slug', $slug)->first();
            };

        $newPost->slug = $slug;

        $newPost->save();

        return redirect()->route("post.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];

        return view("details", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postToEdit = Post::findOrFail($id);

        $data = [
            'post' => $postToEdit
        ];

        return view("edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $post = Post::findOrFail($id);

        $post->update($data);

        return redirect()->route("post.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route("post.index");
    }
}
