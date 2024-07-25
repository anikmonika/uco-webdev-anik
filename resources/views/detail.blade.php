<x-template>
    <div class="mb-3">
        <a href="{{ route('catalog') }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <section>
                <div id="carouselImage" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach($product->images as $idx => $image)
                        <div class="carousel-item {{ $idx == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/product/'.$image->name) }}" class="d-block" style="max-height:500px">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImage" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselImage" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>
        </div>
        <div class="col-lg-7">
            <div class="mt-3">
                <section>
                    <h3>{{ $product->name }}</h3>
                    <h1 class="fw-bold text-danger">Rp {{ number_format($product->price, 0, ',', '.') }}</h1>
                </section>
                <form class="my-4" method="post" action="{{ route('cart.add', ['product_id' => $product->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        Add to cart
                    </button>
                </form>
                <section>
                    <div class="fw-semibold mb-2">Description</div>
                    <p>{{ $product->description }}</p>
                </section>
            </div>
        </div>
    </div>

    @can('edit_product', $product)
    <div class="position-fixed end-0 bottom-0 pe-3 pb-3">
        <a href="{{ route('product-edit', ['id' => $product->id]) }}" class="btn btn-success">
            <i class="fa fa-edit"></i>
            Edit product
        </a>
    </div>
    @endcan
</x-template>