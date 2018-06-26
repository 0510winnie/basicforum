@extends('layouts.default')
@section('title','更新個人資料')

@section('content')
<div class="col-md-8 offset-md-2">
  <div class="card">
    <div class="card-header">
      <h5>更新個人資料</h5>
    </div>
    <div class="card-body">

      @include('shared._errors')

      <div class="gravatar_edit">
        <a href="http://gravatar.com/emails" target="blank">
        <img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar">
        </a>
      </div>

      <form action=" {{ route('users.update', $user->id) }}" method="POST">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <!-- 在 RESTful 架构中，我们使用 PATCH 动作来更新资源，
          但由于浏览器不支持发送 PATCH 动作，
          因此我们需要在表单中添加一个隐藏域来伪造 PATCH 请求。-->

        <div class="form-group">
          <label for="name">名稱：</label>
          <input type="text" name="name" class="form-control" value=" {{ $user->name }}">
        </div>

        <div class="form-group">
          <label for="email">Email：</label>
          <input type="text" name="email" class="form-control" value=" {{ $user->email }}" disabled>
        </div>

        <div class="form-group">
          <label for="password">密碼：</label>
          <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>

        <div class="form-group">
          <label for="password_confirmation">確認密碼：</label>
          <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </div>
  </div>
</div>
@endsection
