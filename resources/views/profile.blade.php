@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control" name="nama" id="nama" placeholder="Contoh : John Doe" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="Contoh : johndoe@gmail.com" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                              <label for="no_hp">No Hp</label>
                              <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Contoh : 081234XXXX" value="{{ $user->no_hp }}">
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" style="resize: none;">{{ $user->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <img src="{{ asset('/storage/foto/'.$user->foto) }}" width="200" height="200" class="img-fluid py-4">
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control border-0" name="foto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><p class="font-weight-bold">Change Password</p></div>
                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="password_lama">Password Lama</label>
                              <input type="password" class="form-control" name="password_lama" id="password_lama">
                            </div>
                            <div class="form-group">
                              <label for="password_baru">Password Baru</label>
                              <input type="password" class="form-control" name="password_baru" id="password_baru">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
