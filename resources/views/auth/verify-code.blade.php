@extends('layouts.auth.layout')

@section('title')
    Verify Code
@endsection

@section('content')
    <div class="card my-auto overflow-hidden">
        <div class="row g-0">
           <div class="col-lg-6">
                <div class="bg-overlay" style="background-color: #cf080d;"></div>
                <div class="h-100 bg-auth d-flex justify-content-center align-items-end">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid mb-4" style="max-width: 250px;">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="p-lg-5 p-4">
                    <div>
                        <div class="text-center mt-1">
                            <h4 class="font-size-18">Verify Code</h4>
                            <p class="text-muted">Verify your code to Tocly.</p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('verify-code-proses') }}" class="auth-input" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label for="code" class="form-label">Verification Code</label>
                                <input type="text" name="code" id="code"
                                    class="form-control @error('code') is-invalid @enderror" maxlength="6"
                                    placeholder="Enter Your Code" required autofocus>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
@endsection
