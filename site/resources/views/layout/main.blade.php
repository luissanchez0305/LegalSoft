
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('index-title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset("/css/styles.css")}}" />
    <link rel="stylesheet" href="{{ asset("css/app-".(\Session::has('theme') ? \Session::get('theme') : 'gold').".css") }}" />

    <style>
    @yield('index-style')
    </style>
  </head>
  <body>
    <div class="container">
    @yield('index-context')
    </div>

    <script src="{{ asset("/js/app.js") }}" type="text/javascript"></script>
    <script type="text/javascript">

      $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('.validation-enabled').validator(); // Form validation
      })
    </script>
    <script src="{{ asset("vendor/ckeditor/ckeditor.js") }}" type="text/javascript"></script>
    @yield('index-javascript')
</body>
</html>