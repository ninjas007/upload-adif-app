@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<style>
    table tr th,
    table tr td {
        padding: 7px !important;
    }
</style>
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
                    <div style="overflow-x: scroll;">
                        <table class="table table-bordered" id="myTable" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th width="180">Member</th>
                                    <th>Info</th>
                                    <th width="150">Registrasi</th>
                                    <th style="text-align: center;" width="100">Award</th>
                                    <th style="text-align: center;" width="140">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
    $(function() {
        $.noConflict();
        // $('#myTable').DataTable();

        $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": BASE_URL+"/admin/jsonAdminMembers",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "member" },
                { "data": "info" },
                { "data": "registrasi" },
                { "data": "award" },
                { "data": "action" }
            ],
            "columnDefs" : [
                {
                    "targets": -2,
                    "className": 'text-center'
                },
                {
                    "targets": -1,
                    "className": 'text-center'
                }
            ]
        });

        $('#myTable').on('click', '.detail', function(){
            let id = $(this).data('id')
            $.ajax({
                url: BASE_URL+'/admin/member/detail',
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
