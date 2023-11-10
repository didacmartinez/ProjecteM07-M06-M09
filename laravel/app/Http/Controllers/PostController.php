<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("posts.index", [
            "posts" => Post::all()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    

    return view("posts.create");
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'upload' => 'required|mimes:gif,jpg,png|max:2048',
        'body' => 'required',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ], [
        'upload.mimes' => 'Solo se admiten archivos de tipo jpg, gif, png.',
    ]);

    $filePath = $request->file('upload')->store('uploads', 'public');

    $file = File::create([
        'filepath' => $filePath,
        'filesize' => $request->file('upload')->getSize(),
    ]);

    $post = Post::create([
        'body' => $validatedData['body'],
        'file_id' => $file->id,
        'latitude' => $validatedData['latitude'],
        'longitude' => $validatedData['longitude'],
        'author_id' => auth()->user()->id,
    ]);

    return redirect()->route('posts.index')
        ->with('success', 'Post successfully saved');
}

    
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $files = File::all();
        return view('posts.edit', compact('post', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validación de la solicitud
        $request->validate([
            'body' => 'required',
            'file_id' => 'required|exists:files,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $post->update([
            'body' => $request->input('body'),
            'file_id' => $request->input('file_id'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('posts.show', $post->id)
            ->with('success', 'Post successfully updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            $message = 'Post deleted successfully.';
            $redirectRoute = 'posts.index';
        } catch (\Exception $e) {
            $message = 'Unable to delete the post.';
            $redirectRoute = 'posts.show';
        }

        return redirect()->route($redirectRoute, $post->id)->with('success', $message);
    }

}
