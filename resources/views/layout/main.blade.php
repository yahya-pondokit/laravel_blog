<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('assets/bs/bs.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/layout.css') }}">
        @yield('style')
        <script src="{{ asset('assets/bs/bs.js') }}"></script>
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand big-site-name" href="#">CVLT</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-left">
                <li class="active"><a href="#">BLOG</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">CONTACT</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

        @yield('content')

        <div id="footer">

        </div>
    </body>
</html>