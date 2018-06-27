@extends('layouts.default')
@section('title', '登入')

@section('content')
  <div class="row">
    <div class="col-sm-6 offset-sm-3">
      <div class="card">
        <div class="card-header">
            <h5>登入</h5>
          </div>
        <div class="card-body">
          @include('shared._errors')
          <form action=" {{ route('login') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
              <lable for="email">Email：</lable>
                <input type="text" name="email" class="form-control" value=" {{ old('email') }}">
            </div>

            <div class="form-group">
              <label for="password">密碼 (<a href="{{ route('password.request') }}">忘記密碼</a>）：</label>
              <input type="password" name="password" class="form-control" value="{{ old('password') }}">
            </div>

            <div class="checkbox">
              <label><input type="checkbox" name="remember">  記住我</label>
            </div>

            <button type="submit" class=" btn btn-primary">登入</button>
          </form>

          <hr>

          <p>沒有帳號嗎？<a href=" {{ route('signup') }}">現在註冊！</a>
        </div>
      </div>
    </div>
  </div>
@endsection