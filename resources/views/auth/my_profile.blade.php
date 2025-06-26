@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body text-center">
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('storage/avatars/default/default.jpg') }}"
                             alt="{{ auth()->user()->name }}'s Avatar"
                             class="rounded-circle mb-3 border"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <h4 class="card-title mb-1">{{ auth()->user()->name }}</h4>

                        <p class="text-muted mb-2">{{ auth()->user()->email }}</p>

                        <p class="text-secondary small">
                            Registered on {{ auth()->user()->created_at->format('F d, Y') }}
                        </p>

                        <hr class="my-4">

                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary mb-2">
                            change
                        </a>

                        <form action="{{ route('profile.delete', auth()->user()->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the user account?');">
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
