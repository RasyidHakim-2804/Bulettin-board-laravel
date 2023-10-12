<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostController extends Controller
{
    //home view
    public function index()
    {
        $userId = auth()->id();
        $posts  = Post::orderBy('id','DESC')
                        ->where('user_id', '=',$userId)
                        ->paginate(12);

        return view('post.dashboard', ['posts' => $posts]);
    }

    //post/create view
    public function create()
    {
        return view('post.create');
    }

    //edit view
    public function edit(Post $post)
    {
        if($post->user_id !== Auth::user()->id) abort(404);

        return view('post.edit', ['post' =>$post]);
    }

    public function show()
    {
        
    }


    /*
    *controller for action
    */

    //store Post
    public function store(PostRequest $request)
    {
        Post::create($request->validated());

        // return dd($message);
        return redirect('/posts')
                ->with('message', 'Your message was created successfully');
    }

    //update Post
    public function update(PostRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::user()->id) abort(404);

        $post->update($request->validated());
        
        return redirect('/posts')
                ->with('message', 'message updated successfully');
    }

    //delete Post
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('message','Post successfully deleted');
    }

}
