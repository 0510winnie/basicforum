@extends('layouts.default')
@section('title', $user->name)

@section('content')
<div class="row">
  <div class="col-sm-6 offset-sm-3">
    <div class="col-sm-12">
      <div class="col-sm-6 offset-sm-3">
        <section class="user_info">
          @include('shared._user_info', ['user' => $user])
        </section>
      </div>
    </div>
  </div>
</div>
@endsection