@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Member</div>

                <div class="card-body">
                    <a href="{{ route('admin/members') }}" class="btn btn-danger mb-3">Kembali</a>
                    <form action="{{ route('admin/member/update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="row">
                            <div class="col-md-12 pt-md-4">                                
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                          {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="callsign">Callsign</label>
                                    <input type="text" class="form-control" name="callsign" id="callsign" placeholder="Callsign"  value="{{ $user->callsign }}">
                                </div>
                                <div class="form-group">
                            	    <label for="member_id">Member Id</label>
                            	    <input type="text" class="form-control" name="member_id" id="member_id" placeholder="Member Id" value="{{ $user->member_id }}">
                            	</div>
                                <div class="form-group">
                                    <label for="register">Register</label>
                                    <input type="date" id="register" name="register" class="form-control" value="{{ $user->register }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="free"{{ ($user->category == 'free') ? 'selected' : ''  }}>Free</option>
                                        <option value="premium" {{ ($user->category == 'premium') ? 'selected' : ''  }} >Premium</option>
                                    </select>
                                </div>
                                @php
                                    if($user->category == 'premium') {
                                        $display = 'block';
                                    } else if ($user->category == 'free'){
                                        $display = 'none';
                                    }
                                @endphp
                                <div class="form-group c_premium" style="display: {{ $display  }}">
                                    <label for="class_premium">Class Premium</label>
                                    <select name="class_premium" id="class_premium" class="form-control">
                                        <option value="">Pilih class premium</option>
                                        <option value="gold class" {{ ($user->class_premium == 'gold class') ? 'selected' : ''  }}>Gold Class Premium Member</option>
                                        <option value="silver class" {{ ($user->class_premium == 'silver class') ? 'selected' : ''  }}>Silver Class Premium Member</option>
                                        <option value="bronze class" {{ ($user->class_premium == 'bronze class') ? 'selected' : ''  }}>Bronze Class Premium Member</option>
                                        <option value="early class" {{ ($user->class_premium == 'early class') ? 'selected' : ''  }}>Early Class Premium Member</option>
                                    </select>
                                </div>
                                <div class="form-group life_time" style="display: {{ $display  }}">
                                    <label for="life_time">Life Time</label>
                                    <select name="life_time" id="life_time" class="form-control">
                                        <option value="1" {{ ($user->life_time == 1) ? 'selected' : ''  }}>Aktif</option>
                                        <option value="0" {{ ($user->life_time == 0) ? 'selected' : ''  }}>Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="active">Active</label>
                                    <select name="active" id="active" class="form-control">
                                        <option value="1" {{ ($user->active == 1) ? 'selected' : ''  }}>Aktif</option>
                                        <option value="0" {{ ($user->active == 0) ? 'selected' : ''  }}>Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary float-right" value="Submit">
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
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/Javascript">
    $(document).ready(function(){
        $('#category').change(function(){
            if ($(this).val() == 'premium') {
                $('.c_premium').css('display', 'block');
                $('.life_time').css('display', 'block');
            } else {
                $('.c_premium').css('display', 'none');
                $('.life_time').css('display', 'none');
            }
        });
    });
</script>
@endsection
