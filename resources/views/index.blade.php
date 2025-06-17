@extends('layouts/app')

@section('content')
    <div class="container">
        <h1>Products</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create New Product</a>

        @if($products->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Feature</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="{{ $product->is_featured ? 'table-featured' : '' }}">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->type->name }}</td>
                        <td>
                            <form action="{{ route('products.toggleFeature', $product->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="checkbox" name="feature" onchange="this.form.submit()" {{ $product->is_featured ? 'checked' : '' }}>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

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
