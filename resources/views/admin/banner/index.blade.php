@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Banner</div>
                <div class="card-body" id="content">
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
                    <table class="table table-bordered text-center" id="myTable" >
                        <thead>
                            <tr>
                                <th>Nama banner</th>
                                <th>Image</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($banners) == 0)
                            <tr><td colspan="6" style="text-align: center;">Tidak ada data</td></tr>
                            @endif
                            @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $banner->name }}</td>
                                <td>
                                    <a href="{{ $banner->url_image }}" target="_blank"><img src="{{ $banner->url_image }}" width="100"></a>
                                </td>
                                <td>
                                    <a href="/admin/banner/edit/{{ $banner->id }}" class="btn btn-primary btn-sm modal-update">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
