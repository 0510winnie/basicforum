<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Sample App') - Laravel 入门教程</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    @include('partials._header')

    <div class="container">
        @include('shared._messages')
        @yield('content')
    </div>
    
    @include('partials._footer')
    
  </body>
</html>