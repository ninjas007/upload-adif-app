@extends('layouts.app')
@section('styles')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Rules</div>

                <div class="card-body" id="content">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          {{ session()->get('success') }}
                        </div>
                    @endif
                    <a href="/admin/rules" class="btn btn-success mb-3">Kembali</a>
                    <button type="button" class="btn btn-success mb-3 float-right" onclick="tambah()">Tambah Baris</button>
                    <form action="/admin/rules/store" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="award">Untuk Award</label>
                                    <select class="form-control" name="award" id="award" required>
                                        <option value="">-- Pilih Award --</option>
                                        @foreach ($awards as $award)
                                            <option value="{{ $award->id }}">{{ $award->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered" id="tableRule">
                                    <thead>
                                        <tr>
                                            <th>Call</th>
                                            <th>Band</th>
                                            <th>Mode</th>
                                            <th width="10">#</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
@endsection
@section('js')
<script type="text/Javascript">
    function tambah(){
        let row = $('.valueKey').length;        
        $('#tableRule tbody').append(`
            <tr>
                <td>
                    <div class="form-group">
                        <label for="call_value">Value</label>
                        <input type="text" class="form-control" id="call_value" name="call_value[]" placeholder="Contoh: YB6">
                    </div>
                    <div class="form-group">
                        <label for="call_min_data">Minimal Data</label>
                        <input type="text" class="form-control" id="call_min_data" name="call_min_data[]" placeholder="Contoh: 5">
                    </div>
                    <div class="form-group">
                        <label for="call_date_start">Qso Date Awal</label>
                        <input type="date" class="form-control" id="call_date_start" name="call_date_start[]">
                    </div>
                    <div class="form-group">
                        <label for="call_date_end">Qso Date Akhir</label>
                        <input type="date" class="form-control" id="call_date_end" name="call_date_end[]">
                    </div>
                </td>
                <td>
                   <div class="form-group">
                       <label for="band_value">Value</label>
                       <input type="text" class="form-control" id="band_value" name="band_value[]" placeholder="Contoh: 15m">
                   </div>
                   <div class="form-group">
                       <label for="band_min_data">Minimal Data</label>
                       <input type="text" class="form-control" id="band_min_data" name="band_min_data[]" placeholder="Contoh: 5">
                   </div>
                   <div class="form-group">
                       <label for="band_date_start">Qso Date Awal</label>
                       <input type="date" class="form-control" id="band_date_start" name="band_date_start[]">
                   </div>
                   <div class="form-group">
                       <label for="band_date_end">Qso Date Akhir</label>
                       <input type="date" class="form-control" id="band_date_end" name="band_date_end[]">
                   </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="mode_value">Value</label>
                        <input type="text" class="form-control" id="mode_value" name="mode_value[]" placeholder="Contoh: FT8">
                    </div>
                    <div class="form-group">
                        <label for="mode_min_data">Minimal Data</label>
                        <input type="text" class="form-control" id="mode_min_data" name="mode_min_data[]" placeholder="Contoh: 5">
                    </div>
                    <div class="form-group">
                        <label for="mode_date_start">Qso Date Awal</label>
                        <input type="date" class="form-control" id="mode_date_start" name="mode_date_start[]">
                    </div>
                    <div class="form-group">
                        <label for="mode_date_end">Qso Date Akhir</label>
                        <input type="date" class="form-control" id="mode_date_end" name="mode_date_end[]">
                    </div>
                </td>
                <td style="vertical-align: middle;"><button type="button" class="btn btn-danger btn-sm hapus">x</button></td>
            </tr>
        `)

        hapus();

        $(`.rulesKey${row}`).change(function(){
            if ($(this).val() == 'qso_date_start' || $(this).val() == 'qso_date_end') {
                $(`.tdValue${row}`).prop({type:"date"});
            } else {
                $(`.tdValue${row}`).prop({type:"text"});
            }
        });
    }

    function hapus() {
        $('.hapus').click(function(){
            $(this).parent().parent().remove();
        });
    }

    hapus();
</script>
@endsection
