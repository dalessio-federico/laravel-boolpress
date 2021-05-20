<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $data = [
            'users' => $users
        ];
        return view('userIndex', $data);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        

        $data = [
            'user' => $user
        ];
        return view('userdetails', $data);
    }
}
