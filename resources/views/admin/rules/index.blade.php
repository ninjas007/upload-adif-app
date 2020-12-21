@extends('layouts.app')
@section('styles')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Rules</div>

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
                    <a href="/admin/rules/tambah" class="btn btn-success btn-sm mb-3">Tambah Rules</a>
                    <table class="table table-bordered" id="myTable" style="font-size: 12px">
                        <thead>
                            <tr>
                                <th>Rules</th>
                                <th>Untuk Award</th>
                                <th class="text-center" width="100">Aksi</th>
                            </tr>
                            @if (!empty($rules))
                            @foreach ($rules as $rule)
                                <tr>
                                    @foreach ($rule as $k => $r)
                                        @if ($k == 'id')
                                            @continue
                                        @endif
                                        <td>{!! $r !!}</td>
                                    @endforeach
                                    <td align="center">
                                        <a href="/admin/rules/hapus/{{ $rule['id'] }}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr><td colspan="3" class="text-center">Data kosong</td></tr>
                            @endif
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
