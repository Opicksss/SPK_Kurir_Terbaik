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
                            <h4 class="font-size-18">Reset Password</h4>
                            <p class="text-muted">Reset your password to Tocly.</p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('forgot-proses') }}" class="auth-input" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label for="useremail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="useremail" placeholder="Enter email"
                                    name="email" required>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary w-100" type="submit">Krim</button>
                            </div>
                            <div class="mt-2">
                                <button type="reset" class="btn btn-outline-secondary w-100">Reset</button>
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
@endsection
