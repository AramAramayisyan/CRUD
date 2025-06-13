@extends('layouts/app')

@section('content')
    <div class="container">
        <h1>Products</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Create New Product</a>

        @if($products->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline-block;">
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
