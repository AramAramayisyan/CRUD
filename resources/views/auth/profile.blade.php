@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body text-center p-5">

                        {{-- Avatar --}}
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('storage/avatars/default/default.jpg') }}"
                             alt="{{ $user->name }}'s Avatar"
                             class="rounded-circle mb-4 border border-3"
                             style="width: 150px; height: 150px; object-fit: cover;">

                        {{-- User Info --}}
                        <h4 class="card-title mb-1 fw-bold">{{ $user->name }}</h4>
                        <p class="text-muted mb-1">{{ $user->email }}</p>
                        <p class="text-secondary small mb-4">
                            {{__('profile.registered')}} <strong>{{ $user->created_at->format('F d, Y') }}</strong>
                        </p>

                        <hr class="my-4">

                        {{-- Role Change (Admin Only) --}}
                        @if(Auth::user()->role === 'admin')
                            <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="mb-4 text-start">
                                @csrf
                                @method('PUT')

                                <label class="fw-bold mb-2 d-block">{{__('profile.role')}}</label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="roleUser" value="user"
                                           {{ $user->role === 'user' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="roleUser">{{__('profile.user')}}</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="roleManager" value="manager"
                                        {{ $user->role === 'manager' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="roleManager">{{__('profile.manager')}}</label>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success w-100">{{__('profile.update_role')}}</button>
                                </div>
                            </form>
                        @endif

                        {{-- Profile Actions --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('profile.products', $user->id) }}" class="btn btn-outline-primary">
                                {{__('profile.products')}}                            </a>

                            <form action="{{ route('profile.delete', $user->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this user account?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    {{__('profile.delete')}}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
