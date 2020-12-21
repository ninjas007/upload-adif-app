@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Tambah Admin</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  {{ session()->get('success') }}
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  {{ session()->get('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin/listAdmin') }}" class="btn btn-success mb-3">Kembali</a>
                            <form action="{{ route('admin/admin-tambah') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp">No Hp</label>
                                            <input type="text" class="form-control" name="no_hp" id="no_hp">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" name="password" id="password" value="{{ old('email') }}">
                                        </div>
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                    <div class="col-md-6 pt-md-4">                                
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                  {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/Javascript">
    $(document).ready( function () {
        $.noConflict();
        $('#myTable').DataTable();
    } );
</script>
@endsection
