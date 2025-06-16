<!-- resources/views/store.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Product Stored</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Product Successfully Stored</h2>

    @if(isset($product))
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $product->name }}</h5>
                <p class="card-text">Description: {{ $product->description }}</p>
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-4">
            No product data available.
        </div>
    @endif
    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Back to Product List</a>
</div>
</body>
</html>
