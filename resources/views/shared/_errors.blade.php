@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Laravel 默认会将所有的验证错误信息进行闪存。
  当检测到错误存在时，Laravel会自动将这些错误消息绑定到视图上，
  因此我们可以在所有的视图上使用 errors 变量来显示错误信息。
  需要注意的是，在我们对 errors 进行使用时，
  要先使用 $errors->any() 检查其值是否为空。 --> 
  