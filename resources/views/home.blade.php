<x-template>
    <div class="mb-3 d-md-flex align-items-center">
        <div class="flex-grow-1 py-2">
            @if($search)
            Found {{ $products->count() }} products that matches keyword <b>{{ $search }}</b>
            @else
            We have {{ $products->count() }} products in our catalog
            @endif
        </div>
        <div class="">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort by: {{ $sort }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('catalog', ['search' => $search, 'sort' => 'most recent']) }}">Most recent</a></li>
                    <li><a class="dropdown-item" href="{{ route('catalog', ['search' => $search, 'sort' => 'lowest price']) }}">Lowest price</a></li>
                    <li><a class="dropdown-item" href="{{ route('catalog', ['search' => $search, 'sort' => 'highest price']) }}">Highest price</a></li>
                    <li><a class="dropdown-item" href="{{ route('catalog', ['search' => $search, 'sort' => 'name a-z']) }}">Name A-Z</a></li>
                    <li><a class="dropdown-item" href="{{ route('catalog', ['search' => $search, 'sort' => 'name z-a']) }}">Name Z-A</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-6 col-lg-3">
            <div class="card mb-3">
                <a href="{{ route('catalog-detail', ['id' => $product->id]) }}" class="btn btn-light p-0 border-0 text-start">
                    <img src="https://i.pinimg.com/736x/a3/d4/6a/a3d46abacd288542901c4d7cffa089a9.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="card-title">{{ $product->name }}</div>
                        <div class="text-danger fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="position-fixed end-0 bottom-0 pe-3 pb-3">
        <a href="{{ route('product-create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            Add product
        </a>
    </div>
    <div></div>
</x-template>