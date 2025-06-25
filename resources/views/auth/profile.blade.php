@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body text-center">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('storage/avatars/default/default.jpg') }}"
                             alt="{{ $user->name }}'s Avatar"
                             class="rounded-circle mb-3 border"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <h4 class="card-title mb-1">{{ $user->name }}</h4>

                        <p class="text-muted mb-2">{{ $user->email }}</p>

                        <p class="text-secondary small">
                            Registered on {{ $user->created_at->format('F d, Y') }}
                        </p>

                        <hr class="my-4">

                        <a href="{{ route('profile.products', $user->id) }}" class="btn btn-outline-primary mb-2">
                            Product
                        </a>

                        <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the user account?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete Accaunt
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
