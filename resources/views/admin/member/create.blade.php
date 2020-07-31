@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Member</div>

                <div class="card-body">
                    <a href="{{ route('admin/members') }}" class="btn btn-danger mb-3">Kembali</a>
                    <form action="{{ route('admin/member-tambah') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="callsign">Callsign</label>
                                    <input type="text" class="form-control" name="callsign" id="callsign" placeholder="Callsign">
                                </div>
                                <div class="form-group">
                            	    <label for="member_id">Member Id</label>
                            	    <input type="text" class="form-control" name="member_id" id="member_id" placeholder="Member Id">
                            	</div>
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="free">Free</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="register">Register</label>
                                    <input type="date" id="register" name="register" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                            <div class="col-md-6 pt-md-4">                                
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
