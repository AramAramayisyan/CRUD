@extends('layouts/app')

@section('content')
    <div class="container" style="max-width: 600px; margin-top: 40px;">
        <h2 class="mb-4 text-primary">Edit Project</h2>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">Project Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control form-control-lg"
                    value="{{ old('name', $product->name) }}"
                    required
                    placeholder="Enter project name"
                >
            </div>

            <div class="mb-4">
                <label for="description" class="form-label fw-semibold">Description</label>
                <textarea
                    name="description"
                    id="description"
                    class="form-control"
                    rows="5"
                    placeholder="Describe the project"
                >{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
@endsection
