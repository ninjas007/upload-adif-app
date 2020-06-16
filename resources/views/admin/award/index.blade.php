@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Award</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('admin/award-tambah') }}" class="btn btn-success mb-3">Tambah Award</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Award</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th style="text-align: right;" width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($awards) == 0)
                                <tr><td colspan="5" style="text-align: center;">Belum ada data</td></tr>
                            @endif
                            @foreach ($awards as $key => $award)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $award->nama }}</td>
                                    <td>{{ $award->deskripsi }}</td>
                                    <td><img src="{{ $award->url_gambar }}" width="100"></td>
                                    <td style="text-align: right;">
                                        <a href="/admin/awards/ubah/{{ $award->uuid }}" class="btn btn-sm btn-primary mb-2">Ubah</a>
                                        <a href="/admin/awards/hapus/{{ $award->id }}" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $awards->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
