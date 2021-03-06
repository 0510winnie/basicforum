@extends('layouts.default')
@section('title', '更新密碼')

@section('content')
  <div class="row">
    <div class="col-sm-6 offset-sm-3">
      <div class="card">
        <div class="card-header">
          <h5>更新密碼</h5>
        </div>

        <div class="card-body">
          @if(session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <form action="{{ route('password.update') }}" method="POST">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            {{-- 在用戶提交表單時，會將密碼重置令牌通過隱藏輸入框一同提交給conroller的getReset進行處理 --}}
            <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">Email:</label>
              <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">密碼：</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">確認密碼：</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        修改密码
                    </button>
                </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection