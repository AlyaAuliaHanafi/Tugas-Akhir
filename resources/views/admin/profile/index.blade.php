@extends('layouts.backend.master')
@section('title')
    Profile Saya
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Profile</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('assets/images/profile.svg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-6">
                    <form action="{{ route('admin.profile.update') }}" style="margin-top: 100px" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ auth()->user()->name }}" autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ auth()->user()->email }}" autocomplete="off">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
