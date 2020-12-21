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
                            @foreach ($awards as $award)
                                <tr>
                                    <td>{{ $award['nama'] }} <br> <a href="{{ $award['url_award'] }}" title="click here for details award" target="_blank" class="text-danger">Click Here</a></td>
                                    <td>{{ strtoupper($award['category']) }}</td>
                                        @php
                                            $mess = 'Process / Unclaimed';
                                            $cd = '<button type="button" title="Click to check award" class="btn btn-success btn-sm" disabled>Download</button>';
                                            if ($award['user_awards']) {
                                                foreach ($award['user_awards'] as $user_award) {
                                                    if(Auth::user()->id == $user_award['user_id'] && $award['id'] == $user_award['award_id']) {
                                                        $mess = 'Success';
                                                        $cd = '<a href="'.$user_award['link_googledrive'].'" title="Click to download award" class="btn btn-primary btn-sm">DOWNLOAD</a>';
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                    <td>{{ $mess }}</td>
                                    <td class="text-center">{!! $cd !!}</td>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/Javascript">
    $(document).ready( function () {
        $.noConflict();
        $('#myTable').DataTable();

        $('.check').on('click', function(){
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
