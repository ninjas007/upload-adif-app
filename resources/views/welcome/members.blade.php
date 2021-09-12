@extends('welcome.layout')
@section('content')
<p style="font-size: 20px" class="text-center border p-1">Members</p>
<div class="row">
    <div class="col-12">
        <div class="form-group mt-5">
            <label>Please enter your call sign</label>
            <input type="text" class="form-control" id="callsign" placeholder="Callsign" aria-label="Callsign" aria-describedby="submit" style="width: 70%;">
        </div>
        <br>
        <button type="button" class="btn btn-primary" id="submit">Submit</button>
    </div>
    <div class="col-12" id="content">
        
    </div>
</div>

@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/Javascript">
    $(function() {
        $('#submit').click(function(){
            callsign = $('#callsign').val();

            if (callsign == "") {
                return alert('please input callsign')
            }
            
            $.ajax({
                url: '/detailMember',
                dataType: 'json',
                data: {callsign: callsign},
                success: function(response) {
                     member = response.member

                     html = ``;
                     
                     if (response.total_records > 0) {
                         $.each(response.records, function(index, award) {
                             html += `<tr>
                                 <td>${award.award_name}</td>
                                 <td style="text-transform: capitalize">${award.award_category}</td>
                                 <td class="text-center"><a href="${award.award_url}" target="_blank">Click Here</a></td>
                             </tr>`
                         });
                     }

                     content = `
                     <table class="table mt-3" cellpadding="0" cellspacing="0" style="font-size: 12px;">
                        <tr>
                             <td style="width: 150px;">Member Id</td>
                             <td>:</td>
                             <td style="vertical-align: middle;">${member.member_id}</td>
                             <td rowspan="6" align="right">`+memberFoto(member.foto)+`</td>
                         </tr>
                         <tr>
                             <td style="width: 150px;">Name</td>
                             <td>:</td>
                             <td style="vertical-align: middle;">${member.name}</td>
                         </tr>
                         <tr>
                            <td style="width: 150px;">Callsign</td>
                            <td>:</td>
                            <td style="vertical-align: middle;">${member.callsign}</td>
                        </tr>
                         <tr>
                            <td  style="width: 150px;" colspan="1">Category Member</td>
                            <td>:</td>
                            <td style="vertical-align: middle;">${member.category}</td>
                        </tr>
                        <tr>
                            <td  style="width: 150px;" colspan="1">Register</td>
                            <td>:</td>
                            <td style="vertical-align: middle;">${member.register}</td>
                        </tr>
                        `+memberExpired(member.category, member.life_time, member.expired)+`
                       
                         ${member.category == 'Premium' 
                         ? `<tr><td style="vertical-align: middle;" class="text-info font-weight-bold" colspan="3">
                                ${member.class_premium}
                            </td></tr>` 
                         : ''}
                         <tr><td style="vertical-align: middle;" colspan="3">`+memberAlamat(member.alamat)+`</td></tr>
                     </table>
                     <hr>
                     <div class="text-center">RECORDS</div>
                     <table class="table" cellpadding="0" cellspacing="0" style="font-size: 12px;">
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
                     </table>
                     `;
                     $('#content').html(content)
                },
                error: function(err) {
                    content = `
                    <div class="text-center mt-3">User not found</div>`;
                    $('#content').html(content);
                }
            });

            function memberAlamat(alamat) {
                 return alamat == null ? '-' : alamat;
            }

            function memberFoto(foto) {
                 return foto == 'profile.jpg' ? `<img src="profile.jpg" width="200" class="float-right">` : `<img src="/storage/foto/${foto}"  width="200">`;
            }

            function memberExpired(category, life_time, expired) {
                if(member.life_time == 1) {
                    life_time = 'Life Time';
                } else {
                    life_time = expired;
                }

                if (category != 'Free') {
                    return ` <tr>
                            <td  style="width: 150px;" colspan="1">Expired</td>
                            <td>:</td>
                            <td style="vertical-align: middle;">`+life_time+`</td>
                        </tr>`;
                } else {
                    return ` <tr>
                            <td  style="width: 150px;" colspan="1">Expired</td>
                            <td>:</td>
                            <td style="vertical-align: middle;">-</td>
                        </tr>`;
                }
                
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