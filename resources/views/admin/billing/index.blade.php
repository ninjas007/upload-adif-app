@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <style>
        table tr th,
        table tr td {
            padding: 7px !important;
            vertical-align: middle !important;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-white bg-info font-weight-bold">Billing</div>

                    <div class="card-body" id="content">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        {{-- <a href="{{ url('admin/billing/tambah') }}" class="btn btn-success mb-3">Tambah Billing</a> --}}
                        <div style="overflow-x: scroll;">
                            <table class="table table-bordered" id="myTable" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th width="30%">Member</th>
                                        {{-- nanti keteragnan isinya setiap member punya beberapa award class,, dan keterangan notifikasi sudah terkirim atau belum tagihannya --}}
                                        {{-- <th>Keterangan</th> --}}
                                        <th width="30%">Award Class</th>
                                        <th width="20%">Status Kirim Tagihan Member Baru</th>
                                        <th width="20%">Status Kirim Tagihan Member Baru</th>
                                        <th style="text-align: center;">Tagihan Member Baru</th>
                                        <th style="text-align: center;">Tagihan Perpanjangan</th>
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

    <!-- Modal -->
    {{-- <div class="modal fade" id="modalKirimTagihan" tabindex="-1" role="dialog" aria-labelledby="modalKirimTagihan"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKirimTagihan">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="" id="">
                        <option value="">Tagihan Member Baru</option>
                        <option value=""></option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/Javascript">$(function() {
            $.noConflict();
            // $('#myTable').DataTable();

            $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                         "url": BASE_URL+"/admin/billing/get-data",
                         "dataType": "json",
                       },
                "columns": [
                    { "data": "member" },
                    { "data": "award_class" },
                    { "data": "status_kirim" },
                    { "data": "status_kirim2" },
                    { "data": "member_baru" },
                    { "data": "member_perpanjang" },
                ],
                "columnDefs" : [
                    {
                        "targets": -1,
                        "className": 'text-center'
                    },
                    {
                        "targets": -2,
                        "className": 'text-center'
                    }
                ]
            });
        })

        function kirimBilling(id_member)
        {
            let award_class = $(`.award-class-${id_member}`).val();
            $.ajax({
                url: `{{ url('admin/billing/kirim-tagihan') }}?user_id=${id_member}&award_class=${award_class}`,
                dataType: 'json',
                success: function(data){
                    if(data.status_code == 200) {
                        title = 'Berhasil';
                        type = 'success';
                    } else {
                        title = 'Gagal';
                        type = 'error';
                    }

                    swal({
                        title: title,
                        text: data.message,
                        icon: type,
                        button: "Ok",
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(err) {
                    swal({
                        title: 'Gagal',
                        text: 'Billing gagal dikirim, silahkan hubungi admin',
                        icon: 'error',
                        button: "Ok",
                    }).then(() => {
                        location.reload();
                    });
                }
            })
        }</script>
@endsection
