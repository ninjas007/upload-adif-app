@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Award</div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <a href="{{ route('admin/award-tambah') }}" class="btn btn-success mb-3">Tambah Award</a>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Award</th>
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
                                            <td>
                                                <a href="{{ $award->url_award }}" title="Klik untuk melihat award" target="_blank">{{ $award->nama }}</a>
                                            </td>
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
                    </div>
                </div>
                <div class="card-footer">
                    {{ $awards->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
