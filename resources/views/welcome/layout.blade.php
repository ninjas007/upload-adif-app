<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>YB6-DXC</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
        <style>
        body {
        overflow-x: hidden;
        }
        </style>
    </head>
    <body>
        <div class="container px-5">
            <div class="row justify-content-center mt-4">
                    <div class="col-md-12 mb-5">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://yb6-dxc.net/wp-content/uploads/2020/06/sildenews1.jpg" class="img-fluid" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img src="https://ame.biz.id/wp-content/uploads/2020/06/cctvmalang.jpg" class="img-fluid" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img src="https://ame.biz.id/wp-content/uploads/2020/06/panel-1.jpg" class="img-fluid" alt="Image">
                            </div>
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
                    <p style="font-size: 20px" class="text-center border p-1">Menu</p>
                    <ul class="list-group">
                        @if (Route::has('login'))
                        @auth
                        <li class="list-group-item py-2">
                            <a href="{{ url('/home') }}">Home</a>
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
                            <a href="/list-award">Awards</a>
                        </li>
                        <li class="list-group-item py-2">
                            <a href="/list-member">Members</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="row mt-5 bg-dark">
            <div class="col-md-12 text-center">
                <p class="text-white pt-3 font-weight-bold"><a href="#">YB6-DXC</a> - {{ date('Y') }}</p>
            </div>
        </div>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        @yield('js')
    </body>
</html>