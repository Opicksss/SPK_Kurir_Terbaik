@extends('layouts.layout')

@section('title')
    Profile
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Profile Management</h5>
                            </div>

                            <div class="row">
                                <!-- Profile Information -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Informasi Profile</h6>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('profile.update') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           value="{{ $user->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                           value="{{ $user->email }}" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Change Password -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Ubah Password</h6>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('profile.password') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="current_password" class="form-label">Password Lama</label>
                                                    <input type="password" class="form-control" id="current_password"
                                                           name="current_password" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="new_password" class="form-label">Password Baru</label>
                                                    <input type="password" class="form-control" id="new_password"
                                                           name="new_password" required minlength="6">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                                    <input type="password" class="form-control" id="new_password_confirmation"
                                                           name="new_password_confirmation" required minlength="6">
                                                </div>
                                                <button type="submit" class="btn btn-warning">Ubah Password</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
