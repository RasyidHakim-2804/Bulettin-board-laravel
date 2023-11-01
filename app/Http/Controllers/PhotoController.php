<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UploadedFile $fileImage, String $post_id)
    {
        $path = $fileImage->store('user/post');

        Photo::create([
            'title' => basename($path),
            'post_id' => $post_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UploadedFile $fileImage, Photo $photo)
    {
        Storage::delete($photo->title);
        $fileImage->storeAs('user/post', $photo->title);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $path = "user/post/{$photo->title}";
        Storage::delete($path);

        $photo->delete();
    }
}
