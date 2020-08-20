@extends('welcome.layout')
@section('content')
<p style="font-size: 20px" class="text-center border p-1">Members</p>
<table class="table table-bordered" id="myTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Member</th>
            <th>Callsign</th>
            <th>Registered</th>
            {{-- <th>Detail</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
            <tr>
                <td><a href="#" class="detail" data-callsign={{ $member->callsign }}>{{ $member->name }}</a></td>
                <td>{{ ($member->role == 1) ? 'Free' : 'Premium' }}</td>
                <td>{{ $member->callsign }}</td>
                <td>{{ ($member->register == null) ? '-' : $member->register }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/Javascript">
    $(function() {
        $('#myTable').DataTable();
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