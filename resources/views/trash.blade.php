@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">{{__('products.trashed_products')}}</h2>

        @if($trashedProducts->isEmpty())
            <div class="alert alert-info text-center">
                {{__('products.no_trashed_products')}}
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>{{__('products.name')}}</th>
                        <th>{{__('products.type')}}</th>
                        <th>{{__('products.description')}}</th>
                        <th>{{__('products.deleted_at')}}</th>
                        <th class="text-center">{{__('products.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trashedProducts as $product)
                        <tr class="{{ $product->is_featured ? 'table-warning' : '' }}">
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->type->name }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>{{ $product->deleted_at->format('Y-m-d H:i') }}</td>
                            <td class="text-center">
                                <form action="{{ route('products.restore', $product) }}" method="POST" class="d-inline me-1">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" title="Restore">
                                        <i class="bi bi-arrow-counterclockwise"></i> {{__('products.restore')}}
                                    </button>
                                </form>

                                <form action="{{ route('products.forceDelete', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to permanently delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete Permanently">
                                        <i class="bi bi-trash"></i> {{__('products.delete')}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
