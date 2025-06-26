<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Product Stored</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body style="background-color: #f8f9fa;">
<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center mb-4">
        <h2 class="fw-bold" style="color: #2c3e50;">Product Successfully Stored</h2>
    </div>

    @if(isset($product))
        <div class="card shadow-sm" style="width: 100%; max-width: 480px; border-radius: 12px;">
            <div class="card-body">
                <h5 class="card-title text-primary fw-semibold">Name: {{ $product->name }}</h5>
                <p class="card-text text-muted">{{ $product->description }}</p>
            </div>
        </div>
    @else
        <div class="alert alert-warning w-100" style="max-width: 480px;">
            No product data available.
        </div>
    @endif

    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg mt-4 px-4 rounded-pill shadow-sm">
        Back to Product List
    </a>
</div>
</body>
</html>
