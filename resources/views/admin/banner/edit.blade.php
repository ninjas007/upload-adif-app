@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Banner Edit</div>
                <div class="card-body" id="content">
                    <form action="{{ route('admin/banners/update', ['id' => $banner->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control mb-3" id="name" placeholder="Nama Banner" value="{{ $banner->name }}">
                                <input type="text" name="url_image" class="form-control mb-3" id="url_image" placeholder="Url Image" value="{{ $banner->url_image }}">
                                <select name="is_active" id="is_active" class="form-control">
                                    @if ($banner->is_active == 1)
                                    <option value="1" selected>Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                    @else
                                    <option value="1">Aktif</option>
                                    <option value="0" selected>Tidak Aktif</option>
                                    @endif
                                </select>
                                <div class="text-danger mt-2">Ukuran gambar yang diambil dari url baiknya 1170 x 450</div>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ $banner->url_image }}" class="img-fluid">
                            </div>
                            <div class="col-md-6 mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                <a class="btn btn-danger btn-sm" href="/admin/banners">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection