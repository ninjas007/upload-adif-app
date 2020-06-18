@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Award</div>
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
                            <a href="{{ route('admin/award-tambah') }}" class="btn btn-success mb-3">Tambah Award</a>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10">No</th>
                                        <th>Nama Award</th>
                                        <th>Gambar</th>
                                        <th width="180" class="text-center">Action</th>
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
                                            <td class="text-center">
                                                <a href="/admin/award/ubah/{{ $award->uuid }}" class="btn btn-sm btn-primary">Ubah</a>
                                                <a href="/admin/award/hapus/{{ $award->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus award ini?')">Hapus</a>
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
