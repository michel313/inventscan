<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inventscan</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/style.css') !!}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <!-- Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/sweetalert/dist/sweetalert.css') !!}">

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Inventscan
                </a>
            </div>

            <!-- Authentication Links -->
            @if (Auth::check())

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/products') }}">Products</a></li>
                    <li><a href="{{ url('/export') }}">Export</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Beheer <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ url('/suppliers') }}">Suppliers</a></li>
                          <li><a href="{{ url('/categories') }}">Categories</a></li>
                          <li><a href="{{ url('/subcategories') }}">Subcategories</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="{{ url('/locations') }}">Locations</a></li>
                          <li><a href="{{ url('/servers') }}">Servers</a></li>
                          @if(!empty($role) && $role == '2')
                            <li><a href="{{ url('/export-paths') }}">Export Path</a></li>
                          @endif
                      </ul>
                    </li>
                </ul>

                <!-- Searchform -->
                <form class="navbar-form navbar-left" role="search" action="search">
                  <div class="form-group ">
                    <input type="text" class="form-control" name="q" placeholder="Search for products (sku, title)" value="{{ request()->q }}" size="30">
                  </div>
                  <button type="submit" class="btn btn-default">Search</button>
                </form>

                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @include ('flash::message')

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <!-- Sweet Alert -->
    <script src="{!! asset('assets/plugins/sweetalert/dist/sweetalert.min.js') !!}"></script>
    <!-- Site Ajax -->
    <script src="{!! asset('assets/js/siteAjax.js') !!}"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- Ajax Progress Bar -->
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
    <script src="{!! asset('assets/plugins/ajax-progress/jquery.ajax-progress.js') !!}"></script>
    <script type="text/javascript">
        $(function () {
            $('.csv-part select').select2({
                maximumSelectionLength: 2,
                placeholder: "Please Select Row(s)"
            });

        });
    </script>

</body>
</html>
