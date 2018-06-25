<nav class="navbar navbar-expand-lg navbar-light navbar-inverse">
    <a class="navbar-brand" href="#" id="logo">Sample App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ">
        @if(Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hi, {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">個人中心</a>
            <a class="dropdown-item" href="#">編輯資料</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" id="logout">
              <form action=" {{ route('logout') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE')}}
                <button class="btn btn-block btn-danger" type="submit" name="button">登出</button>
              </form>
            </a>
          </div>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="#">登入</a>
        </li>
        @endif
      </ul>
    </div>
  </nav>