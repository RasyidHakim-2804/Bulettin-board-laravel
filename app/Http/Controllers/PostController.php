<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //index view
    public function index()
    {
        $posts = Post::with('author:id,user_name')->paginate(5);

        return view('post.home', ['posts'=> $posts]);
    }

    //post view
    public function create()
    {
        $authorId = Auth::user()->id;
        $posts    = Post::orderBy('id','DESC')->where('author_id', '=',$authorId)->get();

        return view('post.create', ['posts' => $posts]);
    }

    //edit view
    public function edit(int $id)
    {
        //cek apakah ada id seteleah /edit/
        if(!isset($id)) return redirect()->route('post');

        $post    = Post::where('author_id', '=', Auth::user()->id)->findOrFail($id);
        $message = $post->posts_contents;
        
        return view('post.edit', ['id'=> $id, 'message'=> $message]);
    }

    //action untuk update
    public function update(Request $request, int $id)
    {
        $message = $request->validate([
            'post_contents' => 'required|min:10|max:200'
        ]);

        $post                 = Post::find($id);
        $post->posts_contents = $message['post_contents'];
        $post->save();
        
        return redirect()->route('post')->with('message', 'message updated successfully');
    }


    //controller for action
    public function store(Request $request)
    {
        $message = $request->validate([
            'post_contents' => 'required|min:10|max:200'
        ]);

        $post = new Post();
        $post->posts_contents = $message['post_contents'];
        $post->author_id      = Auth::user()->id;
        $post->save();  

        return redirect('/post')->with('message', 'Your message was created successfully');
    }


    public function delete(int $id)
    {
        $post = Post::find($id);

        $post->delete();

        return back()->with('message','Post successfully deleted');
    }

}
