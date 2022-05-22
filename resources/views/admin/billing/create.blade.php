@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Member</div>

                <div class="card-body" id="content">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          {{ session()->get('success') }}
                        </div>
                    @endif
                    <a href="{{ url('admin/billing') }}" class="btn btn-danger mb-3">Kembali</a>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Callsign</label>
                            <input type="text" name="callsign" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Member Class</label>
                            <select name="member_class" id="class_premium" class="form-control">
                                <option value="" selected>Pilih class premium</option>
                                <option value="gold class">Gold Class</option>
                                <option value="silver class">Silver Class</option>
                                <option value="bronze class">Bronze Class</option>
                                <option value="early class">Early Class</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12 text-right">
                            <button type="submit" class="btn btn-success">Kirim Tagihan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
