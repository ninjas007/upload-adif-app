@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Member</div>

                <div class="card-body" id="content">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          {{ session()->get('success') }}
                        </div>
                    @endif
                    <a href="{{ route('admin/member-tambah') }}" class="btn btn-success mb-3">Tambah Member</a>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th width="180">Member</th>
                                <th>Callsign</th>
                                <th width="150">Registrasi</th>
                                <th style="text-align: center;" width="100">Award</th>
                                <th style="text-align: center;" width="140">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($members) == 0)
                                <tr><td colspan="6" style="text-align: center;">Tidak ada data</td></tr>
                            @endif
                            @foreach ($members as $member)
                                <tr>
                                    <td><a href="#" class="detail" data-id="{{ $member->id }}" data-toggle="modal" data-target="#detailModal">{{ $member->name }}  <br> {{ $member->no_hp }}</a></td>
                                    <td>{{ ($member->callsign == null) ? '-' : $member->callsign }}</td>
                                    <td>{{ date('d M Y', strtotime($member->register)) }}</td>
                                    <td align="center">
                                        <a href="/admin/member/award-update/{{ $member->id }}" class="btn btn-success btn-sm">Update</a>
                                    </td>
                                    <td align="center">
                                        <a href="{{ url('admin/member/edit/'.$member->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="/admin/member/hapus/{{ $member->id }}" class="btn btn-danger btn-sm">Hapus</a>
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
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/Javascript">
    $(function() {
        $.noConflict();
        $('#myTable').DataTable();

        $('#myTable').on('click', '.detail', function(){
            let id = $(this).data('id')
            $.ajax({
                url: '/admin/member/detail',
                dataType: 'html',
                data: {id: id},
                success: function(response){
                    console.log(response)
                    $('#content').html(response);
                }
            })
        });
    })
</script>
@endsection
