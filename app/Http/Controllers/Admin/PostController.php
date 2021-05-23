<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::All(),
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'tags' => Tag::all()
        ];
        return view ('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>"required|max:225",
            'content'=> "required",
        ]);
        $formData = $request->all();
        $newPost = new Post();
        $newPost->fill($formData);
        $slug = Str::slug($newPost->title);
        $baseSlug = $slug;
        $existingPost = Post::where('slug',$slug)->first();
        $counter = 1;
        while($existingPost) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
            $existingPost = Post::where('slug', $slug)->first();
        }
        $newPost->slug = $slug;
        $newPost->user_id = Auth::id();
        $newPost->save();
        if(array_key_exists('tags', $formData)){
            $newPost->tags()->sync($formData['tags']);
        };

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        $data = [
            'post' => $post
        ];
        return view('admin.posts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Post::findOrFail($id)){
            $data = [
                'post' => Post::findOrFail($id),
                'tags' => Tag::all()
            ];
        }

        return view('admin.posts.edit',$data);
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
        $data = $request->all();
        

        $editPost = Post::findOrFail($id);
        $slug = Str::slug($editPost->title);
        $baseSlug = $slug;
        $existingPost = Post::where('slug',$slug)->first();
        $counter = 1;
        while($existingPost) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
            $existingPost = Post::where('slug', $slug)->first();
        }
        $editPost->slug = $slug;
        if(array_key_exists('tags', $data)){
            $editPost->tags()->sync($data['tags']);
        }
        else {
            $editPost->tags()->sync([]);
        };
        $editPost->update($data);

        return redirect()->route("admin.posts.index");
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

        $post->delete();

        return redirect()->route("admin.posts.index");
    }
}
