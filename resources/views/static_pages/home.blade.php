@extends('layouts.default')
@section('title','Home')
@section('content')

<!-- jumbotron starts -->
<div class="jumbotron">
    <h1 class="jumbotron_h1"> Start Sharing</h1>
    <p>
      <a class="btn btn-warning btn-lg" href="#" role="button">Register</a>
    </p>
  </div>
<!-- jumbotron ends -->  
@if(Auth::check())
  <div class="row">
    <div class="col-md-8">
      <section class="status_form">
        @include('shared._status_form')
      </section>
      @include('shared._feed')
    </div>
    <aside class="col-md-4">
      <section class="user_info">
        @include('shared._user_info',['user'=> Auth::user()])
      </section>
    </aside>
  </div>
@endif


@endsection