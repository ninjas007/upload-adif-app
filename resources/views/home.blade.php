@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Award</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Link G-Drive</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Award Covid</td>
                                <td><img src="https://yb6-dxc.net/award/wp-content/uploads/sites/6/2020/04/C19-award-10000.jpg" width="100"></td>
                                <td>Claimed</td>
                                <td><input type="text" class="form-control" value="https://yb6-dxc.net/award/wp-content/uploads/sites/6/2020/04/C19-award-10000.jpg"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Award Covid</td>
                                <td><img src="https://yb6-dxc.net/award/wp-content/uploads/sites/6/2020/04/C19-award-10000.jpg" width="100"></td>
                                <td>Claimed</td>
                                <td><input type="text" class="form-control" value="https://yb6-dxc.net/award/wp-content/uploads/sites/6/2020/04/C19-award-10000.jpg"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Award Covid</td>
                                <td><img src="https://yb6-dxc.net/award/wp-content/uploads/sites/6/2020/04/C19-award-10000.jpg" width="100"></td>
                                <td>Claimed</td>
                                <td><input type="text" class="form-control" value="https://yb6-dxc.net/award/wp-content/uploads/sites/6/2020/04/C19-award-10000.jpg"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
