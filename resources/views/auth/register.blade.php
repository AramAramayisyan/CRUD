@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center py-5" style="min-height: 80vh;">
        <div class="card shadow border-0 rounded-4 p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <h3 class="text-center mb-4">📝 {{__('register.title')}}</h3>

                {{-- Register Form --}}
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">{{__('register.name')}}</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="{{__('register.name_placeholder')}}"
                               required autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">{{__('register.email')}}</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="example@domain.com"
                               required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">{{__('register.password')}}
                        </label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="{{__('register.password_placeholder')}}"
                               required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">{{__('register.register')}}</label>
                        <input type="password"
                               class="form-control"
                               id="password_confirmation"
                               name="password_confirmation"
                               placeholder="{{__('register.password_confirmation_placeholder')}}"
                               required>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-success btn-lg">✅ {{__('register.register')}}</button>
                    </div>
                </form>

                {{-- Login link --}}
                <div class="text-center mt-3">
                    <p class="mb-0">
                        {{__('register.already_have_an_account')}}
                        <a href="{{ route('loginPage') }}" class="text-decoration-none">{{__('register.login')}}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
