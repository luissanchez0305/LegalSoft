
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('index-title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    @yield('index-context')
    </div>
    @yield('index-javascript')
</body>
</html>