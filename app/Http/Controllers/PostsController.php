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
    $data = request()->validate([
      'caption' => 'required',
      'image' => ['required', 'image']
    ]);

    auth()->user()->posts()->create($data);
  }
}
