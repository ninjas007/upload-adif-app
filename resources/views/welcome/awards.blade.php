@extends('welcome.layout')
@section('content')
<p style="font-size: 20px" class="text-center border p-1">Awards</p>
<div class="row">
    @foreach ($awards as $award)
    <div class="col-md-4 mb-3">
        <!-- Card -->
        <div class="card">
            <!-- Card image -->
            <a href="{{ $award->url_award }}">
                <div class="view overlay">
                    <img class="card-img-top img-fluid" src="{{ $award->url_gambar }}" alt="{{ $award->nama }}" style="height: 180px;">
                    <div class="mask rgba-white-slight"></div>
                </div>
            </a>
            <!-- Card content -->
            <div class="card-body text-center">
                <h4 class="card-title">{{ $award->nama }}</h4>
                <p class="card-text">Category : {{ ucfirst($award->category) }}</p>
            </div>
        </div>
    </div>
    @endforeach
    <div class="col-md-12">
        {{ $awards->links() }}
    </div>
</div>
@endsection
@section('js')
@endsection