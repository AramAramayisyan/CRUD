@extends('layouts/app')

@section('content')
    <div class="container">
        <h1>Products</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create New Product</a>

        {{-- Search Form --}}
        <form method="GET" action="{{ route('products.index') }}" class="row g-3 mb-4">
            @csrf
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Search by name" value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
                <select name="type_id" class="form-control">
                    <option value="">-- Select Type --</option>
                    @foreach($data['types'] as $type)
                        <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-secondary">Search</button>
            </div>
        </form>

        @if($data['products']->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Type Name</th>
                    <th>Description</th>
                    <th>Feature</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['products'] as $product)
                    <tr class="{{ $product->is_featured ? 'table-featured' : '' }}">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->type->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <form action="{{ route('products.toggleFeature', $product->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="checkbox" name="feature" onchange="this.form.submit()" {{ $product->is_featured ? 'checked' : '' }}>
                            </form>
                        </td>
                        <td>
                            @if(auth()->id() == $product->user_id)
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
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
        @else
            <p>No projects found.</p>
        @endif
    </div>
@endsection
