<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostController extends Controller
{
    //home view
    public function index()
    {
        $posts = User::find(auth()->id())
            ->posts()
            ->latest()
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
        //tidak akan menampilkan page jika user bukan pemilik post
        if ($post->user_id !== Auth::user()->id) abort(404);

        $photo = $post->photo->title ?? false;

        return view('post.edit', [
            'id'    => $post->id,
            'title' => $post->title,
            'body'  => $post->body,
            'photo' => $photo,
        ]);
    }

    //detail view
    public function show(Post $post)
    {
        return view('detail', [
            'post'  => [
                'id'         => $post->id,
                'title'      => $post->title,
                'user_name'  => $post->user->user_name,
                'updated_at' => $post->updated_at,
                'body'       => $post->body,
            ],
            'photo' =>  $post->photo->title ?? null,
            'comments' => (new CommentController)->index($post), //mengambil komen collection
        ]);
    }


    /*
    *controller for action
    */

    //store Post
    public function store(PostRequest $request)
    {
        $request->validated();

        $post = Post::create($request->safe()->only(['title', 'body']));

        if (isset($request['image'])) {

            $image = $request->file('image');

            (new PhotoController)->store($image, $post->id);
        }

        return redirect('/posts')
            ->with('message', 'Your message was created successfully');
    }

    //update Post
    public function update(PostRequest $request, Post $post)
    {
        //cek apakah post ini milik user?
        if ($post->user_id !== Auth::user()->id) abort(404);

        $request->validated();

        //update post
        $post->update($request->safe()->only(['title', 'body']));

        //update photo jika ada
        if (isset($request['image'])) {

            $photo = new PhotoController();
            $fileImage = $request->file('image');

            if ($post->photo === null) { //jika post sebelumnya tidak memilki image

                $photo->store($fileImage, $post->id);

            } else { //jika post sebelumnya sudah memilki image

                $photo->update($fileImage, $post->photo);
            }
        }

        return redirect('/posts')
            ->with('message', 'message updated successfully');
    }

    //delete Post
    public function destroy(Post $post)
    {
        if ($post->photo !== null) {
            (new PhotoController)->destroy($post->photo);
        }

        $post->delete();

        return back()->with('message', 'Post successfully deleted');
    }
}
