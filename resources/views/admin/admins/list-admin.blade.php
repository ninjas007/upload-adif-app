@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">List Admin</div>
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
                            <a href="{{ route('admin/admin-tambah') }}" class="btn btn-success mb-3">Tambah Admin</a>
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Hp</th>
                                        <th width="180" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) == 0)
                                        <tr><td colspan="5" style="text-align: center;">Belum ada data</td></tr>
                                    @else
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ ($user['no_hp'] == null) ? '-' : $user['no_hp'] }}</td>
                                            <td class="text-center">
                                                <a href="{{ url('') }}/admin/admin-hapus/{{ $user['id'] }}" class="btn btn-danger btn-sm">Hapus</a>
                                                <a href="{{ url('') }}/admin/admin-edit/{{ $user['id'] }}" class="btn btn-primary btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
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
