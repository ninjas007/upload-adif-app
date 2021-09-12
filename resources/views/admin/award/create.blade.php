@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Award</div>

                <div class="card-body">
                    <a href="{{ route('admin/awards') }}" class="btn btn-danger mb-3">Kembali</a>
                    <form action="{{ route('admin/award-tambah') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Award</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Cth: Award Covid 19">
                                </div>
                                <div class="form-group">
                                    <label for="url_award">Url Award</label>
                                    <input type="text" class="form-control" name="url_award" id="url_award" placeholder="Cth: https://yb6-dxc.net/portfolio/president-bronze-award/">
                                </div>
                                <div class="form-group">
                                    <label for="url_gambar">Url Image</label>
                                    <input type="text" class="form-control" name="url_gambar" id="url_gambar" placeholder="Cth: https://yb6-dxc.net/wp-content/uploads/2020/05/PBA-Award-2.jpg">
                                </div>
                                <div class="form-group">
                                    <label for="category_award">Category Award</label>
                                    <select name="category_award" id="category_award" class="form-control">
                                    	<option value="free">Free</option>
                                    	<option value="premium">Premium</option>
                                    	<option value="All member"}>All Member</option>
                                    </select>
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
