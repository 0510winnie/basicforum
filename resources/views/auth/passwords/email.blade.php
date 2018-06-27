@extends('layouts.default') 
@section('title','密碼重置') 

@section('content')
<div class="row">
  <div class="col-sm-6 offset-sm-3">
    <div class="card">
      <div class="card-header">
        <h5>重置密碼</h5>
      </div>
      <div class="card-body">
        @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? 'has-error': '' }}">
            <label for="email" class="col-md-4 control-label">Email:</label>

            <div class="col-md-11">
              <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required> @if($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 offset-md-3">
              <button type="submit" class="btn btn-primary">
                發送密碼重置Email
              </button>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

@endsection