<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','DESC')
                        ->with('user:id,user_name')
                        ->paginate(8);

        return view('home', ['posts'=> $posts]);
    }
}
