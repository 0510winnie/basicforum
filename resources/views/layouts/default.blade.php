<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Sample App') - Laravel Basic Forum</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    @include('partials._header')

    <div class="container container_margin">
        @include('shared._messages')
        @yield('content')
    </div>
    
    @include('partials._footer')

    <script src="/js/app.js"></script>
    
  </body>
</html>