<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        $data = [
            'posts' => $post
        ];
        return view('post',$data);
    }

    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        $data = [
            'post' => $post
        ];
        return view('details',$data);
    }
}
