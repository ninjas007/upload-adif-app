@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-primary font-weight-bold">Upload</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="upload_form">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="adif">File Adif</label>
                                    <input type="file" name="adif" class="form-control" id="adif">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6 pt-md-4 message"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/Javascript">
    $(document).ready(function(){
        $('#upload_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: "{{ route('upload-file') }}",
                method: 'POST',
                data: new FormData(this),
                datatype: 'html',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $('#submit').addClass('disabled');
                    $('#preloader').css('opacity', 0.3);
                    $('#preloader').css('background-color', '#000000');
                    $('#preloader').fadeIn('slow');
                },
                success: function(data) {
                    $('.message').html(` <div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    ${data.msg}
                                </div>`)

                    $('#submit').removeClass('disabled');
                    $('#preloader').fadeOut('slow');
                },
                error: function(data){
                    message = 'There was an error uploading the file, the adif file is too big, please follow the instructions <a href="https://yb6-dxc.net/form-adif-zip/">please click here for you to send your adif file</a>';
                    if (data.status == 500) {
                        message = `There was an error uploading the file, the adif file is too big, please follow the instructions <a href="https://yb6-dxc.net/form-adif-zip/">please click here for you to send your adif file</a>`;
                    }
                    $('.message').html(` <div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    ${message}      
                                </div>`)
                    $('#submit').removeClass('disabled');
                    $('#preloader').fadeOut('slow');
                }
            })
        })
    })
</script>
@endsection
