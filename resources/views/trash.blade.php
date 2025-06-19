@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Trashed Products</h2>

        @if($trashedProducts->isEmpty())
            <div class="alert alert-info">
                There are no products in the trash.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Type Name</th>
                    <th>Description</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trashedProducts as $product)
                    <tr class="{{ $product->is_featured ? 'table-featured' : '' }}">
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->type->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->deleted_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('products.restore', $product) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>

                            <form action="{{ route('products.forceDelete', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
