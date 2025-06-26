@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0 rounded mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Edit Profile</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name"
                                       value="{{ old('name', auth()->user()->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email"
                                       value="{{ old('mails', auth()->user()->email) }}"
                                       class="form-control @error('mails') is-invalid @enderror">
                                @error('mails')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="avatar" class="form-label">Profile Avatar</label>
                                <input type="file" name="avatar" id="avatar"
                                       class="form-control @error('avatar') is-invalid @enderror">
                                @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if(auth()->user()->avatar)
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                             alt="Current Avatar"
                                             class="rounded-circle"
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Change Password</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('profile.editPassword') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="old_password" id="current_password"
                                       class="form-control @error('old_password') is-invalid @enderror">
                                @error('old_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
