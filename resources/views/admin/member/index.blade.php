@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Member</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th width="100">Nama</th>
                                <th>Alamat</th>
                                <th width="150">Registrasi</th>
                                <th style="text-align: center;" width="100">Award</th>
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
                                    <td>{{ ($member->alamat == null) ? '-' : $member->alamat }}</td>
                                    <td>{{ date('d M Y', strtotime($member->created_at)) }}</td>
                                    <td align="center">
                                        <a href="/admin/member/award-update/{{ $member->id }}" class="btn btn-success btn-sm">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
