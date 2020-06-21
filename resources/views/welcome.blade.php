<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>YB6-DXC</title>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 mb-5">
                    <img src="https://yb6-dxc.net/wp-content/uploads/2020/06/sildenews1.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-md-12 text-center mb-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-primary text-white py-2 font-weight-bold mx-1">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary text-white py-2 font-weight-bold mx-1">Login</a>
                            <a href="https://yb6-dxc.net/membership/" target="_blank" class="btn btn-primary text-white py-2 font-weight-bold mx-1">Register</a>
                        @endauth
                    @endif
                </div>
                <div class="col-md-12 text-center">
                    <hr>
                    <p class="text-dark">YB6-DXC - {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </body>
</html>
