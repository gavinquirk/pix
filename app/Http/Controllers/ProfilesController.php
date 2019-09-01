<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
  public function index(User $user)
  {
    return view('profiles/index', compact('user'));
  }

  public function edit(User $user) {
    $this->authorize('update', $user->profile);

    return view('profiles/edit', compact('user'));
  }

  public function update(User $user) {
    $this->authorize('update', $user->profile);

    $data = request()->validate([
      'title' => 'required',
      'description' => 'required',
      'url' => 'url',
      'image' => ''
    ]);

    if (request('image')) {
      // Store image and get filepath
      $imagePath = request('image')->store('profile', 'public');

      // Change image size
      $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
      $image->save();

      $imageArray = ['image' => $imagePath];
    }

    auth()->user()->profile->update(array_merge(
      $data,
      $imageArray ?? []
    ));



    return redirect("/profile/{$user->id}");
  }
}
