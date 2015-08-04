<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
@yield('title', 'Question & Answer')

    </title>
    <!-- bootstrap-->
    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootsketch.css') }}">
    <link media="all" rel="stylesheet" href="{{{ asset('alfredo-ramos/parsedown-extra-laravel/css/emojis.css') }}}">
    <link rel="stylesheet" href="{{ url('css/custom.css') }}"><!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
@yield('style')

    <script src="{{ url('js/vendor/modernizr.js') }}"></script>
  </head>
  <body>
    <div class="container">
@include('partials.header')

@yield('content')

@include('partials.footer')

    </div>
    <script src="{{ url('js/vendor/jquery.js') }}"></script>
    <script src="{{ url('js/bootstrap.js') }}"></script>
    <script src="{{ url('js/vendor.min.js') }}"></script>
@yield('script')

  </body>
</html>