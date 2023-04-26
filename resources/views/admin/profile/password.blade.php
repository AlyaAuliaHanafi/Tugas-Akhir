@extends('layouts.backend.master')
@section('title')
    Ganti Password
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">@yield('title')</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('assets/images/profile.svg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-6">
                    <form action="{{ route('admin.password.update') }}" method="POST" style="margin-top: 100px">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Password Sebelumnya</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                name="old_password" autocomplete="off">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                name="new_password" autocomplete="off">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ulangi Password Baru</label>
                            <input type="password"
                                class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                name="new_password_confirmation" autocomplete="off">
                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
