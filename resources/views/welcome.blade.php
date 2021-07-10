<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>YB6_DXCommunity Member Award</title>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 text-center mb-2">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary text-white py-2 font-weight-bold mx-1">Home</a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary text-white py-2 font-weight-bold mx-1">Login</a>
                    <a href="https://yb6-dxc.net/membership/" target="_blank" class="btn btn-primary text-white py-2 font-weight-bold mx-1">Register</a>
                    @endauth
                    @endif
                    <hr>
                </div>
                <div class="col-md-12 mb-5">
                    <img src="https://yb6-dxc.net/wp-content/uploads/2020/06/sildenews1.jpg" class="img-fluid" alt="Image">
                </div>
                <div class="col-md-12 mb-3">
                    <h3 class="text-center">Awards</h3>
                    <hr>
                </div>
                @foreach ($awards as $award)
                <div class="col-md-4 mb-3">
                    <a href="{{ $award->url_award }}" target="_blank">
                        <div class="card">
                            <img class="card-img-top img-fluid" style="height: 250px !important" src="{{ $award->url_gambar }}" alt="{{ $award->name }}">
                            <div class="card-body text-center bg-light">
                                <p class="card-text">{{ $award->nama }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                <div class="col-md-12 text-center">
                    <a href="https://yb6-dxc.net/" class="btn btn-primary" target="_blank">SHOW ALL</a>
                </div>
                <div class="col-md-12 text-center">
                    <hr>
                    <p class="text-dark">YB6-DXC - {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </body>
</html>