@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center gy-4">

            {{-- Edit Profile --}}
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h5 class="mb-0">👤 {{__('profile.edit')}}</h5>
                    </div>
                    <div class="card-body px-4 py-5">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">{{__('register.name')}}</label>
                                <input type="text" name="name" id="name"
                                       value="{{ old('name', auth()->user()->name) }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="{{__('register.name_placeholder')}}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">{{__('register.email')}}</label>
                                <input type="email" name="email" id="email"
                                       value="{{ old('email', auth()->user()->email) }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="example@domain.com">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="avatar" class="form-label fw-semibold">{{__('profile.avatar')}}</label>
                                <input type="file" name="avatar" id="avatar"
                                       class="form-control @error('avatar') is-invalid @enderror">
                                @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if(auth()->user()->avatar)
                                    <div class="mt-3">
                                        <p class="mb-1 fw-light">{{__('profile.current_avatar')}}:</p>
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                             alt="Current Avatar"
                                             class="rounded-circle shadow"
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">💾 {{__('profile.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Change Password --}}
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-header bg-warning text-dark rounded-top-4">
                        <h5 class="mb-0">🔐 {{__('profile.change_password')}}</h5>
                    </div>
                    <div class="card-body px-4 py-5">
                        <form action="{{ route('profile.editPassword') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="current_password" class="form-label fw-semibold">{{__('profile.current_password')}}</label>
                                <input type="password" name="old_password" id="current_password"
                                       class="form-control @error('old_password') is-invalid @enderror"
                                       placeholder="{{__('profile.current_password_placeholder')}}">
                                @error('old_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">{{__('profile.new_password')}}</label>
                                <input type="password" name="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="{{__('profile.new_password_placeholder')}}">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold">{{__('profile.confirm_password')}}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control"
                                       placeholder="{{__('profile.confirm_password_placeholder')}}">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning btn-lg text-dark">🔁{{__('profile.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
