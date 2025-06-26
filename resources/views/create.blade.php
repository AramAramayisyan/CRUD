@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 480px; margin-top: 60px; background: #fff; padding: 30px 35px; border-radius: 12px; box-shadow: 0 8px 25px rgb(0 0 0 / 0.1);">
        <h2 class="mb-4 text-center" style="font-weight: 700; color: #2c3e50;">Create Project</h2>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" novalidate>
            @csrf

            <div class="mb-4">
                <label for="name" class="form-label fw-bold" style="color: #34495e;">Project Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    required
                    placeholder="Enter project name"
                    style="border-radius: 8px; border: 1.5px solid #ced4da; transition: border-color 0.3s ease;"
                >
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="form-label fw-bold" style="color: #34495e;">Type</label>
                <select
                    name="type_id"
                    id="type"
                    class="form-select form-select-lg @error('type_id') is-invalid @enderror"
                    required
                    style="border-radius: 8px; border: 1.5px solid #ced4da; transition: border-color 0.3s ease;"
                >
                    <option value="" disabled {{ old('type_id') ? '' : 'selected' }}>Select type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="description" class="form-label fw-bold" style="color: #34495e;">Description</label>
                <textarea
                    name="description"
                    id="description"
                    class="form-control form-control-lg @error('description') is-invalid @enderror"
                    rows="4"
                    placeholder="Enter project description"
                    style="border-radius: 8px; border: 1.5px solid #ced4da; transition: border-color 0.3s ease;"
                >{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" style="font-weight: 600; letter-spacing: 0.03em;">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary btn-lg px-4 rounded-pill" style="font-weight: 600; letter-spacing: 0.03em;">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection
