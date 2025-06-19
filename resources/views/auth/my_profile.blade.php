@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body text-center">

                        {{-- Avatar --}}
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('storage/avatars/default/default.jpg') }}"
                             alt="{{ auth()->user()->name }}'s Avatar"
                             class="rounded-circle mb-3 border"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <h4 class="card-title mb-1">{{ auth()->user()->name }}</h4>

                        {{-- Email --}}
                        <p class="text-muted mb-2">{{ auth()->user()->email }}</p>

                        {{-- Registration Date --}}
                        <p class="text-secondary small">
                            Registered on {{ auth()->user()->created_at->format('F d, Y') }}
                        </p>

                        {{-- Divider --}}
                        <hr class="my-4">

                        {{-- Logout Button --}}
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="btn btn-outline-danger">
                            Change
                        </a>

                        <form id="logout-form" action="{{ route('profile.edit') }}" method="POST" class="d-none">
                            @csrf
                            @method('PUT')
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
