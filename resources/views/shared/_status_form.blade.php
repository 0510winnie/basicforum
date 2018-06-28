<!-- status form -->
<form action="{{ route('statuses.store') }}" method="POST">
  @include('shared._errors')
  {{ csrf_field() }}
  <textarea name="content" id="content" rows="4" placeholder="一起來聊聊吧！" class="form-control">{{ old('content') }}</textarea>
  <button type="submit" class="btn btn-outline-warning float-right">發布</button>
</form>
