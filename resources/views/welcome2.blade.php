<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>YB6-DXC</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('mdbootstrap') }}/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="{{ asset('mdbootstrap') }}/css/mdb.min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link href="{{ asset('mdbootstrap') }}/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container px-5">
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 text-center mb-2">
                    <nav class="navbar navbar-expand-lg" style="box-shadow: none;">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav mx-auto">
                                @if (Route::has('login'))
                                @auth
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('/home') }}">Home</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://yb6-dxc.net/membership/" target="_blank" >Register</a>
                                </li>
                                @endauth
                                @endif
                            </ul>
                        </div>
                    </nav>
                    <hr>
                </div>
                <div class="col-md-12 mb-5">
                    <img src="https://yb6-dxc.net/wp-content/uploads/2020/06/sildenews1.jpg" class="img-fluid" alt="Image">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-5">
                    <ul class="nav nav-tabs justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#awards">Awards</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mb-5">
                <div class="tab-content">
                    <div class="tab-pane container active" id="awards">
                        <div class="row">
                            @foreach ($awards as $award)
                            <div class="col-md-4 mb-3">
                                <!-- Card -->
                                <div class="card">
                                    <!-- Card image -->
                                    <a href="{{ $award->url_award }}">
                                        <div class="view overlay">
                                            <img class="card-img-top img-fluid" src="{{ $award->url_gambar }}" alt="{{ $award->nama }}" style="height: 200px;">
                                            <div class="mask rgba-white-slight"></div>
                                        </div>
                                    </a>
                                    <!-- Card content -->
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ $award->nama }}</h4>
                                        <p class="card-text">Category : {{ ucfirst($award->category) }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-md-12 text-center">
                                <a href="https://yb6-dxc.net/" class="btn btn-primary" target="_blank">SHOW ALL</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p style="font-size: 32px" class="text-center">Members</p>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Callsign</th>
                                <th>Register</th>
                            </tr>
                        </thead>
                    </table>  
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <hr>
                    <p class="text-dark">YB6-DXC - {{ date('Y') }}</p>
                </div>
            </div>
        </div>
        <!-- JQuery -->
        <script type="text/javascript" src="{{ asset('mdbootstrap') }}/js/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('mdbootstrap') }}/js/popper.min.js"></script>
        <script type="text/javascript" src="{{ asset('mdbootstrap') }}/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset('mdbootstrap') }}/js/mdb.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/Javascript">
            $(function() {
                $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    ajax: 'user/json',
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'category', name: 'category' },
                        { data: 'callsign', name: 'callsign' },
                        { data: 'register', name: 'register' }
                    ]
                });
            });
        </script>
        <style>
            .dataTables_filter {
                text-align: right !important;
            }
        </style>
    </body>
</html>