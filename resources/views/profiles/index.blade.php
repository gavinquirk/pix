@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-3">
      <img src="https://www.rawshorts.com/freeicons/wp-content/uploads/2017/01/media-pict-camera.png"
        class="rounded-circle" style="width: 100%" alt="Logo">
    </div>
    <div class="col-9 pt-5">
      <div class="d-flex justify-content-between align-items-baseline">
        <h1>{{ $user->username }}</h1>
        @can('update', $user->profile)
        <a href="/p/create">Add New Post</a>
        @endcan
      </div>

      @can('update', $user->profile)
      <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
      @endcan

      <div class="d-flex">
        <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> Posts</div>
        <div class="pr-5"><strong>23K</strong> Followers</div>
        <div class="pr-5"><strong>212</strong> Following</div>
      </div>
      <div class="pt-4 font-weight-bold">
        {{ $user->profile->title }}
      </div>
      <div>{{ $user->profile->description }}</div>
      <div><a href="#">{{ $user->profile->url }}</a></div>
    </div>
  </div>

  <div class="row pt-5">
    @foreach($user->posts as $post)
    <div class="col-4 pb-4">
      <a href="/p/{{ $post->id }}">
        <img src="/storage/{{$post->image}}" alt="Computer" class="w-100">
      </a>
    </div>
    @endforeach
  </div>

</div>
@endsection