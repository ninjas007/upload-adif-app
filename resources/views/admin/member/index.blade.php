@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Member</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tanggal Registrasi</th>
                                <th style="text-align: right;" width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($members) == 0)
                                <tr><td colspan="5" style="text-align: center;">Tidak ada data</td></tr>
                            @endif
                            @foreach ($members as $key => $member)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $member->name }} <br> {{ $member->no_hp }}</td>
                                    <td>{{ $member->alamat }}</td>
                                    <td>{{ date('d M Y', strtotime($member->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
