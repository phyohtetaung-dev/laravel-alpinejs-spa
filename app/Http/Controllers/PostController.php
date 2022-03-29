<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Get all posts from storage
     *
     * @return array
     */
    public function getAll()
    {
        return Post::orderByDesc('id')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $file = $data['image'];
        if ($file) {
            $name = md5(round(microtime(true) * 1000) . $file->getClientOriginalName());
            $path = $file->storeAs('covers', $name);
            $data['image'] = Storage::url($path);
        }
        Post::create($data);
        return response()->json(['message' => 'A post was created successfully.'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $file = $data['image'];
        if ($file) {
            $name = md5(round(microtime(true) * 1000) . $file->getClientOriginalName());
            $path = $file->storeAs('covers', $name);
            $data['image'] = Storage::url($path);
        }
        $post->update($data);
        return response()->json(['message' => 'A post was updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'A post was deleted successfully'], 200);
    }
}
