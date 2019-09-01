<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    // Create post
    auth()->user()->posts()->create([
      'caption' => $data['caption'],
      'image' => $imagePath
    ]);

    // Redirect user
    return redirect('/profile/' . auth()->user()->id);

  }
}
