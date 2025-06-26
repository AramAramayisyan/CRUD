@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body text-center p-5">

                        {{-- Avatar --}}
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('storage/avatars/default/default.jpg') }}"
                             alt="{{ auth()->user()->name }}'s Avatar"
                             class="rounded-circle mb-4 border border-3"
                             style="width: 150px; height: 150px; object-fit: cover;">

                        {{-- User Info --}}
                        <h4 class="card-title mb-1 fw-bold">{{ auth()->user()->name }}</h4>
                        <p class="text-muted mb-1">{{ auth()->user()->email }}</p>
                        <p class="text-secondary small mb-4">
                            Registered on <strong>{{ auth()->user()->created_at->format('F d, Y') }}</strong>
                        </p>

                        <hr class="my-4">

                        {{-- Profile Actions --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                Edit Profile
                            </a>

                            <form action="{{ route('profile.delete', auth()->user()->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete your account? This action is irreversible.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete Account
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
