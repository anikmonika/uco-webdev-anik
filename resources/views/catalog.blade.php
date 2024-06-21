@extends('layouts.app')

@section('content')
<div class="container">
    <form method="GET" action="{{ route('catalog') }}" class="mb-4">
        <input type="text" name="search" class="form-control" placeholder="Type to search..." value="{{ request('search') }}" aria-label="Search products">
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>
    
    @if(isset($query))
        <p>Found {{ $products->count() }} products that match keyword <strong>{{ $query }}</strong></p>
    @endif

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>
</div>
@endsection