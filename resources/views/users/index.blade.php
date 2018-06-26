@extends('layouts.default')
@section('title','所有用戶')

@section('content')
<div class="col-md-8 offset-md-2">
  <h2 class="users_index_title">所有用戶</h2>
  <ul class="users">
    @foreach($users as $user)
      @include('users._user')
    @endforeach
  </ul>

  {!! $users->render() !!}
</div>
@endsection