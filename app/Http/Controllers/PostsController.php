<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
  public function __construct() {
    // Require auth
    $this->middleware('auth');
  }


  public function create() {
    return view('posts/create');
  }

  public function store() {
    // Validate incoming data
    $data = request()->validate([
      'caption' => 'required',
      'image' => ['required', 'image']
    ]);

    // Store image and get filepath
    $imagePath = request('image')->store('uploads', 'public');

    // Change image size
    $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
    $image->save();


    // Create post
    auth()->user()->posts()->create([
      'caption' => $data['caption'],
      'image' => $imagePath
    ]);

    // Redirect user
    return redirect('/profile/' . auth()->user()->id);

  }

  public function show(\App\Post $post) {
    return view('posts/show', compact('post'));
  }
}
