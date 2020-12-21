@extends('welcome.layout')
@section('content')
<p style="font-size: 20px" class="text-center border p-1">Members</p>
<table class="table table-bordered" id="myTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Callsign</th>
            <th>Registered</th>
            <th>Expired</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<!-- The Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/Javascript">
    $(function() {
        $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/jsonMembers",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "#" },
                { "data": "name" },
                { "data": "category" },
                { "data": "callsign" },
                { "data": "register" },
                { "data": "expired" }
            ]    

        });

        // $('#myTable').DataTable();
        $("#myTable").on("click", ".detail", function(e){
           e.preventDefault();
           let callsign = $(this).data('callsign');
           let memberid = $(this).data('memberid');

           $.ajax({
               url: '/detailMember',
               dataType: 'json',
               data: {callsign: callsign},
               success: function(response) {
                    member = response.member

                    html = ``;
                    
                    if (response.total_records > 0) {
                        $.each(response.records, function(index, award) {
                            console.log(award)
                            html += `<tr>
                                <td>${award.award_name}</td>
                                <td style="text-transform: capitalize">${award.award_category}</td>
                                <td class="text-center"><a href="${award.award_url}" target="_blank">Click Here</a></td>
                            </tr>`
                        });
                    }

                    content = `<table class="table" cellpadding="0" cellspacing="0" style="font-size: 12px;" id="myTable2">
                        <tr><td style="vertical-align: middle;" colspan="2">Member ID `+memberid+`</td></tr>
                        <tr>
                            <td style="vertical-align: middle; width: 70%;">${member.name}</td>
                            <td rowspan="4">`+memberFoto(member.foto)+`</td>
                        </tr>
                        <tr><td style="vertical-align: middle;">${member.callsign}</td></tr>
                        <tr><td style="vertical-align: middle;">${member.category}</td></tr>
                        ${member.category == 'Premium' ? `<tr><td style="vertical-align: middle;" class="text-info font-weight-bold">${member.class_premium}</td></tr>` : ''}
                        <tr><td style="vertical-align: middle;">`+memberAlamat(member.alamat)+`</td></tr>
                        <tr><td colspan="2" align="center">RECORDS</td></tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-inverse">
                                    <tr><th>Award</th>
                                    <th>Category</th>
                                    <th class="text-center">Link</th>
                                    </tr>
                                    `+html+`
                                    <tfoot>
                                        <tr><td colspan="3" align="center" class="font-weight-bold">Total awards : ${response.total_records}</td></tr>
                                    </tfoot>
                                </table>
                            </td>
                        </tr>
                    </table>`;
                    $('.modal-body').html(content)
                    $('#myModal').modal('show')
                    $('#myTable2').DataTable();
               }
           });

           function memberAlamat(alamat) {
                return alamat == null ? '-' : alamat;
           }

           function memberFoto(foto) {
                return foto == 'profile.jpg' ? `<img src="profile.jpg" width="120" class="float-right">` : `<img src="/storage/foto/${foto}"  class="img-fluid">`;
           }
        });
    });
</script>
<style>
    table#myTable {
        font-size: 13px;
    }

    table tr th, table tr td {
        padding: 8px !important;
    }
</style>
@endsection