@if($user->id !== Auth::user()->id)
{{-- 當用戶訪問自己頁面表單不該被顯示出來 --}}
<div id="follow_form">
  @if(Auth::user()->isFollowing($user->id))
  {{-- 當用戶已被關注時 --}}
  <form action="{{ route('followers.destroy', $user->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-sm btn-outline-primary ">取消關注</button>
  </form>
  @else
  {{-- 未被關注時 --}}
  <form action="{{ route('followers.store', $user->id) }}" method="POST">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-sm btn-primary">關注</button>
  </form>
  @endif
</div>
@endif