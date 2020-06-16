@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Award</div>

                <div class="card-body">
                    <a href="{{ route('admin/awards') }}" class="btn btn-danger mb-3">Kembali</a>
                    <form action="{{ route('admin/award-tambah') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Award</label>
                                    <input type="text" class="form-control" name="nama" id="nama">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="url_gambar">Url Gambar</label>
                                    <input type="text" class="form-control" name="url_gambar" id="url_gambar">
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
