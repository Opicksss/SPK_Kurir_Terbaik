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
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="current_password"
                                                               name="current_password" required>
                                                        <span class="input-group-text toggle-password" data-target="current_password" style="cursor: pointer;">
                                                            <i class="fa fa-eye toggle-password-icon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="new_password" class="form-label">Password Baru</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="new_password"
                                                               name="new_password" required minlength="6">
                                                        <span class="input-group-text toggle-password" data-target="new_password" style="cursor: pointer;">
                                                            <i class="fa fa-eye toggle-password-icon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="new_password_confirmation"
                                                               name="new_password_confirmation" required minlength="6">
                                                        <span class="input-group-text toggle-password" data-target="new_password_confirmation" style="cursor: pointer;">
                                                            <i class="fa fa-eye toggle-password-icon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-warning">Ubah Password</button>
                                                 <button type="reset" class="btn btn-secondary">Reset</button>
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const toggleIcon = this.querySelector('.toggle-password-icon');
                
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                toggleIcon.classList.toggle('fa-eye');
                toggleIcon.classList.toggle('fa-eye-slash');
            });
        });
    });
</script>
@endsection
