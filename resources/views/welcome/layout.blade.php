@php
    date_default_timezone_set('Asia/Jakarta');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>YB6_DXCommunity Member Award</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
        <style>
        body {
        overflow-x: hidden;
        }
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
<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>      
    </head>
    <body>
        <div id="preloader"></div>
        <div class="container px-5">
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 mb-5">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($banners as $key => $banner)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ $banner->url_image }}" alt="{{ $banner->name }}" style="max-height: 400px; max-width: 100%;">
                                </div>    
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <p style="font-size: 20px" class="text-center border p-1"><a href="">YB6_DXCommunity</a></p>
                    <ul class="list-group">
                        @if (Route::has('login'))
                        @auth
                        <li class="list-group-item py-2">
                            <a href="{{ url('/home') }}">Home</a>
                        </li>
                        <li class="list-group-item py-2">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                        @else
                        <li class="list-group-item py-2">
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="list-group-item">
                            <a href="https://yb6-dxc.net/membership/" target="_blank">Register</a>
                        </li>
                        @endauth
                        @endif
                        <li class="list-group-item py-2">
                            <a href="/list-member">Members</a>
			<li class="list-group-item py-2">
                            <a href="https://yb6-dxc.net/managers/" target="">Manager</a>
                        </li>
                        <li class="list-group-item py-2">
                            <a href="/list-award">Awards</a>
                        </li>
                        <li class="list-group-item py-2">
                            <a href="https://yb6-dxc.net/released-award-list/" target="">Released Award List</a>
                        </li>
                        <li class="list-group-item py-2">
                            <a href="https://yb6-dxc.net/help-desk/" target="">Help Desk</a>
                        </li>
                    </ul>
                    <div class="card text-center my-3">
                        <div class="border">
                            {{-- {{ date('d-m-Y') }} <br> --}}
                            {{-- <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span> --}}
                            <div style="text-align:center;padding:1em 0;"><h4>Server Time</h4> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=small&timezone=Asia%2FJakarta" width="100%" height="90" frameborder="0" seamless></iframe> </div>
                        </div>		
                    </div>
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="row mt-5 bg-dark">
            <div class="col-md-12 text-center">
                <p class="text-white pt-3 font-weight-bold"><a href="https://yb6-dxc.net/">YB6_DXCommunity</a> - {{ date('Y') }}</p>
            </div>
            </div>
        </div>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        @yield('js')
        <script type="text/javascript">
            // window.setTimeout("waktu()", 1000);
         
            // function waktu() {
            //     var waktu = new Date();
            //     setTimeout("waktu()", 1000);
            //     document.getElementById("jam").innerHTML = (waktu.getHours()) < 10 ? '0'+waktu.getHours() : waktu.getHours();
            //     document.getElementById("menit").innerHTML = (waktu.getMinutes()) < 10 ? '0'+waktu.getMinutes() : waktu.getMinutes();
            //     document.getElementById("detik").innerHTML = (waktu.getSeconds() < 10) ? '0'+waktu.getSeconds() : waktu.getSeconds();
            // }
            $('#preloader').fadeOut('slow');
        </script>
    </body>
</html>