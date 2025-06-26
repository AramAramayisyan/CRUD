@extends('layouts/app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4 text-primary fw-bold">Products</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">
            <i class="bi bi-plus-lg me-2"></i> Create New Product
        </a>

        {{-- Search Form --}}
        <form method="GET" action="{{ route('products.index') }}" class="row g-3 mb-4 align-items-center">
            @csrf
            <div class="col-md-5">
                <input type="text" name="name" class="form-control" placeholder="Search by name" value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
                <select name="type_id" class="form-select">
                    <option value="">-- Select Type --</option>
                    @foreach($data['types'] as $type)
                        <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </div>
        </form>

        @if($data['products']->count())
            <div class="table-responsive rounded shadow-sm border">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-primary text-center">
                    <tr class="text-uppercase small fw-semibold">
                        <th>ID</th>
                        <th class="text-start"><i class="bi bi-box me-1"></i> Project Name</th>
                        <th><i class="bi bi-tags me-1"></i> Type Name</th>
                        <th class="text-start"><i class="bi bi-chat-left-text me-1"></i> Description</th>
                        <th><i class="bi bi-star-fill me-1"></i> Feature</th>
                        <th><i class="bi bi-gear me-1"></i> Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['products'] as $product)
                        <tr class="{{ $product->is_featured ? 'bg-light-success' : '' }} text-center align-middle">
                            <td>{{ $product->id }}</td>
                            <td class="text-start fw-semibold">{{ $product->name }}</td>
                            <td>
                                <span class="badge bg-info text-dark text-capitalize">{{ $product->type->name }}</span>
                            </td>
                            <td class="text-muted text-start" style="max-width: 300px;">
                                {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                            </td>
                            <td>
                                <form action="{{ route('products.toggleFeature', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" name="feature" onchange="this.form.submit()" {{ $product->is_featured ? 'checked' : '' }}>
                                </form>
                            </td>
                            <td>
                                @if(auth()->id() == $product->user_id)
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning text-dark me-2">
                                        Edit
                                    </a>
                                @endif

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this project?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted fs-5">No projects found.</p>
        @endif
    </div>
@endsection
