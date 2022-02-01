@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<style>
    #myTable td {
        vertical-align: middle !important;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-primary font-weight-bold">Awards</div>
                <div class="card-body">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>CLAIM AWARDS</th>
                                <th>CATEGORY</th>
                                <th width="250">CLAIM STATUS</th>
                                <th width="150" class="text-center">DOWNLOAD</th>
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
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/Javascript">
    $(document).ready( function () {
        $.noConflict();
        // $('#myTable').DataTable();

        $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": BASE_URL+"/jsonAwards",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "claim_award" },
                { "data": "category" },
                { "data": "claim_status" },
                { "data": "download" }
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

        $('#myTable').on('click', '.check', function(){
            $.ajax({
                url: '/checkAwardToClaim',
                dataType: 'json',
                data: {id: $(this).data('id')},
                beforeSend: function(){
                    $('#preloader').css('opacity', 0.3);
                    $('#preloader').css('background-color', '#000000');
                    $('#preloader').fadeIn('slow');
                },
                success: function(response) {
                    $('#preloader').fadeOut('slow');
                    let msg = ``;
                    $.each(response.message, function(i, j){
                        msg += `<small>${j}</small> | `
                    });

                    const div = document.createElement("div");
                    div.innerHTML = `<p>Matching data from your record adif : </p>
                                    <p style="font-size: 14px;">Call: ${typeof(response.call) == 'undefined' ? '---' : response.call}, <br> Band: ${typeof(response.band) == 'undefined' ? '---' : response.band}, <br> Mode: ${typeof(response.mode) == 'undefined' ? '---' : response.mode}</p>
                                    <hr> <small style="font-size: 14px;">${msg}</small>
                                    <hr> ${response.rule}`;

                    swal({
                        title: "Report",
                        content: div,
                        allowOutsideClick: "true"
                    })
                    .then(()=>{
                        if (response.rule == '<div class="text-success">FULFILLED</div>') {
                            location.reload();
                        }
                    })
                },
                error: function(err) {
                    $('#preloader').fadeOut('slow');
                    const div = document.createElement("div");
                    div.innerHTML = `<p>${err.responseJSON.message}</p>`;
                    swal({
                        title: "Report",
                        content: div,
                        allowOutsideClick: "true"
                    });
                }
            })
        });
    });
</script>
@endsection
