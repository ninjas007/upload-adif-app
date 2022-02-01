@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

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
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Award</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th width="180" class="text-center">Action</th>
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
                     "url": BASE_URL+"/admin/jsonAwardsMember",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "award" },
                { "data": "category" },
                { "data": "image" },
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

    })
</script>
@endsection

 {{-- @if (count($awards) == 0)
                                        <tr><td colspan="5" style="text-align: center;">Belum ada data</td></tr>
                                    @endif
                                    @foreach ($awards as $award)
                                        <tr>
                                            <td>
                                                <a href="{{ $award->url_award }}" title="Klik untuk melihat award" target="_blank">{{ $award->nama }}</a>
                                            </td>
                                            <td>{{ strtoupper($award->category) }}</td>
                                            <td><img src="{{ $award->url_gambar }}" width="100"></td>
                                            <td class="text-center">
                                                <a href="/admin/award/ubah/{{ $award->uuid }}" class="btn btn-sm btn-primary">Ubah</a>
                                                <a href="/admin/award/hapus/{{ $award->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus award ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
