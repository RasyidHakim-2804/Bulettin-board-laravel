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
        $posts = Post::orderBy('id','DESC')
                        ->with('user:id,user_name')
                        ->paginate(8);

        return view('post.home', ['posts'=> $posts]);
    }

    //post/create view
    public function create()
    {
        $userId = auth()->id();
        $posts  = Post::orderBy('id','DESC')
                        ->where('user_id', '=',$userId)
                        ->paginate(12);

        return view('post.create', ['posts' => $posts]);
    }

    //edit view
    public function edit(User $user,Post $post)
    {
        if($user->id !== Auth::user()->id) abort(404);

        return view('post.edit', ['post' =>$post]);
    }


    /*
    *controller for action
    */

    //store Post
    public function store(PostRequest $request)
    {
        Post::create($request->validated());

        // return dd($message);
        return redirect()
                ->route('post')
                ->with('message', 'Your message was created successfully');
    }

    //update Post
    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->validated());
        $post->save();
        
        // return dd($message);
        return redirect()
                ->route('post')
                ->with('message', 'message updated successfully');
    }

    //delete Post
    public function delete(Post $post)
    {
        $post->delete();

        return back()->with('message','Post successfully deleted');
    }

}
