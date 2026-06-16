@extends('layouts.auth.layout')

@section('title')
    Reset Password
@endsection

@section('content')
    <div class="card my-auto overflow-hidden">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="bg-overlay" style="background-color: #cf080d;"></div>
                <div class="h-100 bg-auth align-items-end d-flex justify-content-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 250px;">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="p-lg-5 p-4">
                    <div>
                        <div class="text-center mt-1">
                            <h4 class="font-size-18">Reset Password</h4>
                            <p class="text-muted">Reset your password to Tocly.</p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('reset-password-proses') }}" method="POST">
                            @csrf

                            <div class="mb-2">
                                <label for="password" class="form-label"> New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" placeholder="Enter New password"
                                        name="password" required>
                                    <span class="input-group-text toggle-password-btn" data-target="password" style="cursor: pointer;">
                                        <i class="fa fa-eye toggle-password-icon"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="Enter Password Confirmation" name="password_confirmation" required>
                                    <span class="input-group-text toggle-password-btn" data-target="password_confirmation" style="cursor: pointer;">
                                        <i class="fa fa-eye toggle-password-icon"></i>
                                    </span>
                                </div>
                            </div>


                            <div class="mt-4">
                                <button class="btn btn-primary w-100" type="submit">Krim</button>
                            </div>


                        </form>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="mb-0">Don't have an account ? <a href="{{ route('login') }}"
                                class="fw-medium text-primary">
                                Log in </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-password-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const targetId = button.dataset.target;
                    const input = document.getElementById(targetId);
                    if (!input) {
                        return;
                    }
                    const icon = button.querySelector('.toggle-password-icon');
                    const newType = input.type === 'password' ? 'text' : 'password';
                    input.type = newType;
                    if (icon) {
                        icon.classList.toggle('fa-eye');
                        icon.classList.toggle('fa-eye-slash');
                    }
                });
            });
        });
    </script>
@endsection
