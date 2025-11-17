@extends('layouts.auth.layout')

@section('title')
    Login
@endsection

@section('content')
    <div class="card my-auto overflow-hidden">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="bg-overlay bg-primary"></div>
                <div class="h-100 bg-auth align-items-end">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="p-lg-5 p-4">
                    <div>
                        <div class="text-center mt-1">
                            <h4 class="font-size-18">Welcome Back !</h4>
                            <p class="text-muted">Sign in to continue to Tocly.</p>
                        </div>

                        <form action="{{ route('login-proses') }}" method="POST" class="auth-input">
                            @csrf

                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password-input">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password-input" name="password"
                                        placeholder="Enter password" required>
                                    <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                                        <i class="fa fa-eye" id="toggle-password-icon"></i>
                                    </span>
                                </div>
                            </div>




                            <div class="d-flex justify-content-end mb-3">
                                <a class="font-bold" href="{{ route('forgot') }}">Forgot password?</a>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary w-100" type="submit">Sign
                                    In</button>
                            </div>
                            <div class="mt-2">
                                <button type="reset" class="btn btn-outline-secondary w-100">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password-input');
        const toggleBtn = document.getElementById('toggle-password');
        const toggleIcon = document.getElementById('toggle-password-icon');
        toggleBtn.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>
