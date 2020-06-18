@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-primary font-weight-bold">Awards</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="10">#</th>
                                <th>Award Name</th>
                                <th width="250">Status</th>
                                <th width="50" class="text-center">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($awards as $key => $award)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><a href="{{ $award->url_award }}" title="Klik untuk melihat award" target="_blank">{{ $award->nama }}</a></td>
                                    @if (count($userAwards) == 0)
                                        <td>Process / Unclaimed</td>
                                        <td class="text-center"><a href="#" title="Klik untuk mendownload award" class="btn btn-primary btn-sm">Download</a></td>
                                    @endif
                                    @foreach ($userAwards as $user_award)
                                        @if ($award->id == $user_award->award_id)
                                            <td>Success</td>
                                            <td class="text-center"><a href="{{ $user_award->link_googledrive }}" title="Klik untuk mendownload award" class="btn btn-primary btn-sm" disabled target="_blank">Download</a></td>
                                        @else
                                            <td>Process / Unclaimed</td>
                                            <td class="text-center"><a href="#" title="Klik untuk mendownload award" class="btn btn-primary btn-sm">Download</a></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $awards->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
