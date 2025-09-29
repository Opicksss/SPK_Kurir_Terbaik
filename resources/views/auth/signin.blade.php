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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password-input">Password</label>
                                <input type="password" class="form-control" id="password-input" name="password"
                                    placeholder="Enter password" required>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="auth-remember-check">
                                <label class="form-check-label" for="auth-remember-check">
                                    Remember me
                                </label>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary w-100" type="submit">Sign
                                    In</button>
                            </div>
                        </form>

                    </div>

                    <div class="mt-4 text-center">
                        <p class="mb-0">Don't have an account ? <a href="auth-register.html"
                                class="fw-medium text-primary">
                                Register </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
