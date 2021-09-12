@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Award</div>

                <div class="card-body">
                    <a href="{{ route('admin/awards') }}" class="btn btn-danger mb-3">Kembali</a>
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
                    <form action="/admin/award/ubah/{{ $award->uuid }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Award</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{ $award->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Url Award</label>
                                    <input type="text" class="form-control" name="url_award" id="url_award" value="{{ $award->url_award }}">
                                </div>
                                <div class="form-group">
                                    <label for="url_gambar">Url Image</label>
                                    <input type="text" class="form-control" name="url_gambar" id="url_gambar" value="{{ $award->url_gambar }}">
                                </div>
                                <div class="form-group">
                                    <label for="category_award">Category Award</label>
                                    <select name="category_award" id="category_award" class="form-control">
                                    	<option value="free" {{ ($award->category == 'free') ? 'selected' : '' }}>Free</option>
                                    	<option value="premium" {{ ($award->category == 'premium') ? 'selected' : '' }}>Premium</option>
                                    	<option value="All member" {{ ($award->category == 'All member') ? 'selected' : '' }}>All Member</option>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ $award->url_gambar }}" class="img-fluid pt-3">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
