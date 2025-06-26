@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center py-5" style="min-height: 80vh;">
        <div class="card shadow border-0 rounded-4 p-4" style="max-width: 450px; width: 100%;">
            <div class="card-body">
                <h3 class="text-center mb-4">🔐 Login to Your Account</h3>

                {{-- Error messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Please fix the following:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="example@domain.com"
                               required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="Enter your password"
                               required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">➡️ Login</button>
                    </div>
                </form>

                {{-- Register Link --}}
                <div class="text-center">
                    <p class="mb-0">Don't have an account?
                        <a href="{{ route('registration') }}" class="text-decoration-none">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
