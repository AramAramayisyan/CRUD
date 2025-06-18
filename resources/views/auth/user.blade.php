@extends('layouts.app') {{-- assuming you're using layouts/app.blade.php --}}

@section('content')
    <div class="container">
        <h2>User Profile</h2>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">{{ auth()->user()->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p class="card-text"><strong>Registered at:</strong> {{ auth()->user()->created_at->format('F d, Y') }}</p>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger mt-3">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
