<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>YB6_DXCommunity Member Award</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- Custom --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        div#preloader {
          position: fixed;
          left: 0;
          top: 0;
          z-index: 99999;
          width: 100%;
          height: 100%;
          overflow: visible;
          background: #fff url('/preloader.gif') no-repeat center center;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div id="preloader"></div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">YB6_DXCommunity</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto text-center py-3">
                        @guest
                        @else
                            @can('isMember')
                                <li class="nav-item {{ (request()->is('awards')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('awards') }}">Awards</a></li>
                                <li class="nav-item {{ (request()->is('profile')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                                @if(auth()->user()->category != 'free')
                                    <li class="nav-item {{ (request()->is('upload')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('upload') }}">Upload File</a></li>
                                @endif
                            @elsecan('isAdmin')
                            <li class="nav-item">
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin/awards') }}">Awards</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin/members') }}">Members</a></li>
                                @if (Auth::user()->manager == 0 && Auth::user()->role == 0)
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin/banners') }}">Banner</a></li>
                                <!--<li class="nav-item"><a class="nav-link" href="{{ route('admin/rules') }}">Rules</a></li>-->
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin/listAdmin') }}">Administrator</a></li>
                                @endif
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin/setting') }}">Setting</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/billing') }}">Billing</a></li>
                            </li>
                            @endcan
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto text-center py-3">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('js')
    <script type="text/Javascript">
        var BASE_URL = `{{ url('') }}`;
        $('#preloader').fadeOut('slow');
    </script>
</body>
</html>
