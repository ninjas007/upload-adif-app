@extends('layouts.app')

@section('styles')
<style>
    table {
        width: 100%;
    }
    table td {
        padding: 5px !important;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-danger font-weight-bold">Tambah Admin</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin/listAdmin') }}" class="btn btn-success mb-3">Kembali</a>
                            <form action="{{ url('admin/admin-update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" id="nama" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp">No Hp</label>
                                            <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ $user->no_hp }}">
                                        </div>
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                    <div class="col-md-6">
                                        <table style="width: 100%" border="1">
                                            <tr>
                                                <td align="center">Menu</td>
                                                <td colspan="3" align="center">Action</td>
                                            </tr>
                                            @php
                                                $menus = [];
                                            @endphp
                                            @if(count($fitur_akses) > 0)
                                                @foreach($fitur_akses as $menu => $fitur)
                                                    @php
                                                        $menus[] = $fitur->menu;
                                                    @endphp
                                                    @if($fitur->menu == 'members')
                                                        <tr>
                                                            <td align="center">
                                                                {{ Str::upper($fitur->menu) }} <input type="hidden" name="menu[{{ $fitur->menu }}]">
                                                            </td>
                                                            @php
                                                                $fitur_akses = json_decode($fitur->fitur_akses);
                                                            @endphp
                                                            @if(isset($fitur_akses->award))
                                                                <td> Award <br> <input type="checkbox" style="line-height: 0" name="menu[members][award]" checked></td>
                                                            @else
                                                                <td> Award <br> <input type="checkbox" style="line-height: 0" name="menu[members][award]"></td>
                                                            @endif

                                                            @if(isset($fitur_akses->update))
                                                                <td>Update <br> <input type="checkbox" style="line-height: 0" name="menu[members][update]" checked></td>
                                                            @else
                                                                <td>Update <br><input type="checkbox" style="line-height: 0" name="menu[members][update]"></td>
                                                            @endif

                                                            @if(isset($fitur_akses->delete))
                                                                <td>Delete <br> <input type="checkbox" style="line-height: 0" name="menu[members][delete]" checked></td>
                                                            @else
                                                                <td>Delete <br> <input type="checkbox" style="line-height: 0" name="menu[members][delete]"></td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                    @if($fitur->menu == 'billing')
                                                        <tr>
                                                            <td align="center">
                                                                BILLING <input type="hidden" name="menu[{{ $fitur->menu }}]">
                                                            </td>
                                                            @php
                                                                $fitur_akses = json_decode($fitur->fitur_akses);
                                                            @endphp
                                                            @if(isset($fitur_akses->akses_billing))
                                                                <td colspan="3">
                                                                    <select name="menu[billing][akses_billing]" class="form-control">
                                                                        <option value="0" {{ (isset($fitur_akses->akses_billing) && $fitur_akses->akses_billing == 0) ? 'selected' : '' }}>Batasi Akses</option>
                                                                        <option value="1" {{ (isset($fitur_akses->akses_billing) && $fitur_akses->akses_billing == 1) ? 'selected' : '' }}>Beri Akses</option>
                                                                    </select>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            {{-- kalau belum ada menu members di setiap user --}}
                                            @if(in_array('members', $menus) == false)
                                                <tr>
                                                    <td align="center">
                                                        MEMBERS <input type="hidden" name="menu[members]">
                                                    </td>
                                                    <td>Award <br> <input type="checkbox" style="line-height: 0" name="menu[members][award]"></td>
                                                    <td>Update <br> <input type="checkbox" style="line-height: 0" name="menu[members][update]"></td>
                                                    <td>Delete <br> <input type="checkbox" style="line-height: 0" name="menu[members][delete]"></td>
                                                </tr>
                                            @endif
                                            @if(in_array('billing', $menus) == false)
                                                <tr>
                                                    <td align="center">
                                                        BILLING <input type="hidden" name="menu[billing]">
                                                    </td>
                                                    <td colspan="3">
                                                        <select name="menu[billing][akses_billing]" class="form-control">
                                                            <option value="0">Batasi Akses</option>
                                                            <option value="1">Beri Akses</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
