@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
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
                                <th width="50" class="text-center">DOWNLOAD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($awards as $award)
                                <tr>
                                    <td>{{ $award->nama }} <br> <a href="{{ $award->url_award }}" title="click here for details award" target="_blank" class="text-danger">Click Here</a></td>
                                    <td>{{ strtoupper($award->category) }}</td>
                                    @if (count($userAwards) == 0)
                                        <td>Process / Unclaimed</td>
                                        <td class="text-center"><a href="#" title="Klik untuk mendownload award" class="btn btn-primary btn-sm disabled">DOWNLOAD</a></td>
                                    @endif
                                    @foreach ($userAwards as $user_award)
                                        @if ($award->id == $user_award->award_id)
                                            <td>Success</td>
                                            <td class="text-center"><a href="{{ $user_award->link_googledrive }}" title="Klik untuk mendownload award" class="btn btn-primary btn-sm" disabled target="_blank">DOWNLOAD</a></td>
                                        @else
                                            <td>Process / Unclaimed</td>
                                            <td class="text-center"><a href="#" title="Klik untuk mendownload award" class="btn btn-primary btn-sm disabled">DOWNLOAD</a></td>
                                        @endif
                                    @endforeach
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
    $(document).ready( function () {
        $.noConflict();
        $('#myTable').DataTable();
    } );
</script>
@endsection
