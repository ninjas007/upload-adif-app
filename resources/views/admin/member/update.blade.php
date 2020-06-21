@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Member</div>

                <div class="card-body">
                    <a href="{{ route('admin/members') }}" class="btn btn-danger mb-3">Kembali</a>
                    <button type="button" class="btn btn-success mb-3 float-right" onclick="tambah()">+ Baris</button>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <form action="/admin/member/award-store/{{ $id }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="300">Nama Award</th>
                                            <th>Link G-Drive Award Member</th>
                                            <th width="10">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($userAwards))
                                            @foreach ($userAwards as $user_award)
                                                <tr>
                                                    <td>
                                                        <select name="award_id[]" class="form-control" required>
                                                            @foreach ($awards as $award)
                                                                <option value="{{ $award->id }}" {{ ($award->id == $user_award->award_id) ? 'selected' : '' }}>{{ $award->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="link_googledrive[]" placeholder="Link google drive award untuk diakses member" value="{{ $user_award->link_googledrive }}" required>
                                                    </td>
                                                    <td><button type="button" class="btn btn-danger btn-sm hapus">x</button></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>
                                                    <select name="award_id[]" class="form-control" required>
                                                        @foreach ($awards as $award)
                                                            <option value="{{ $award->id }}">{{ $award->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="link_googledrive[]" placeholder="Link google drive award untuk diakses member" required>
                                                </td>
                                            </tr>
                                        @endif
                                            <tr class="table-row"></tr>
                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-primary float-right" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/Javascript">
    function tambah(){
        $('.table-row').after(`
            <tr>
                <td>
                    <select name="award_id[]" class="form-control" required>
                        @foreach ($awards as $award)
                            <option value="{{ $award->id }}">{{ $award->nama }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="link_googledrive[]" class="form-control" placeholder="Link google drive award untuk diakses member" required></td>
                <td><button type="button" class="btn btn-danger btn-sm hapus">x</button></td>
            </tr>
        `)

        hapus()
    }

    function hapus() {
        $('.hapus').click(function(){
            $(this).parent().parent().remove()
        })    
    }

    hapus()
    
</script>
@endsection

