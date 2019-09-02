<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
  public function __construct() {
    $this->middware('auth');
  }


  public function store(User $user) {
    // Toggle follow
    return auth()->user()->following()->toggle($user->profile);
  }
}
