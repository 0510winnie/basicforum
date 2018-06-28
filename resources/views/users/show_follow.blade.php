@extends('layouts.default')
@section('title', $title)

@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
    <h1 class="users_index_title">{{ $title }}</h1>
    <ul class="users">
      @foreach($users as $user)
        <li>
          <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar">
          <a href="{{ route('users.show', $user->id) }}" class="username">{{ $user->name }}</a>
        </li>
      @endforeach
    </ul>

    {!! $users->render() !!}
  </div>
</div>
@endsection