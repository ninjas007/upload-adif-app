@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-primary font-weight-bold">Profile</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 pt-md-4">
                            @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  {{ session()->get('success') }}
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  {{ session()->get('error') }}
                                </div>
                            @endif
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
                    
                    <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                    	<div class="col-md-12 text-center">
                        	<h4 class="text-primary"><b>MEMBER {{ strtoupper($user->category) }}</b></h4>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="nama">Name</label>
                              <input type="text" class="form-control" name="nama" id="nama" placeholder="Contoh : John Doe" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="Contoh : johndoe@gmail.com" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                              <label for="no_hp">Phone / WA</label>
                              <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Contoh : 081234XXXX" value="{{ $user->no_hp }}">
                            </div>
                            <div class="form-group">
                              <label for="alamat">Description</label>
                              <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" style="resize: none;">{{ $user->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Callsign</label>
                              <input type="text" class="form-control" value="{{ $user->callsign }}" disabled>
                            </div>
                            <div class="form-group">
                              <label for="">Member Id</label>
                              @if ($user->category == 'premium')
                              	<input type="text" class="form-control" value="YB6_DXCom#{{ substr($user->member_id, -3) }}" disabled>
                              @endif
                              @if ($user->category == 'free')
                              	<input type="text" class="form-control" value="#BSC{{ substr($user->member_id, -3) }}" disabled>
                              @endif
                            </div>
                            <div class="form-group">
                                @if ($user->foto == 'profile.jpg')
                                  <img src="profile.jpg" width="200" height="200" class="img-fluid py-4">
                                @else
                                  <img src="{{ asset('/storage/foto/'.$user->foto) }}" width="200" height="200" class="img-fluid py-4">
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control border-0" name="foto">
                            </div>
                            <div class="form-group">
                                <a href="{{ $user->certificate }}" class="btn btn-primary" target="_blank">Download Certificate</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><p class="font-weight-bold">Change Password</p></div>
                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="password_lama">Old Password</label>
                              <input type="password" class="form-control" name="password_lama" id="password_lama">
                            </div>
                            <div class="form-group">
                              <label for="password_baru">New Password</label>
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
