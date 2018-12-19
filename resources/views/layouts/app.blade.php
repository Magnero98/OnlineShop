<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="http://mymaterials.dx.am/public/css/app.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            @roles('User')
                                <li class="nav">
                                    <a href="{{route('user::carts.index')}}"><span class="fa fa-shopping-cart" style="font-size: 22px; padding-right: 5px"></span> Cart</a>
                                </li>
                                <li class="nav">
                                    <a href="{{route('orders.index')}}"><span class="fa fa-history" style="font-size: 22px; padding-right: 5px"></span> Order History</a>
                                </li>
                            @endroles
                            @roles('Administrator')
                                <li class="nav">
                                    <a href="{{route('admin::products.create')}}"><span class="fa fa-dropbox" style="font-size: 22px; padding-right: 5px"></span> Create Product</a>
                                </li>
                                <li class="nav">
                                    <a href="{{route('admin::users.index')}}"><span class="fa fa-users" style="font-size: 22px; padding-right: 5px"></span> User List</a>
                                </li>
                                <li class="nav">
                                    <a href="{{route('orders.index')}}"><span class="fa fa-bars" style="font-size: 22px; padding-right: 5px"></span> Order List</a>
                                </li>
                            @endroles
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <span class="fa fa-user-circle" style="font-size: 22px; padding-right: 5px"></span> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('users.show', ['id' => Auth::user()->id])}}">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="http://mymaterials.dx.am/public/js/app.js"></script>
</body>
</html>
