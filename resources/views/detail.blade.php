<x-template>
    <div class="mb-3">
        <a href="{{ route('catalog') }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <section>
                <img src="https://i.pinimg.com/736x/a3/d4/6a/a3d46abacd288542901c4d7cffa089a9.jpg" class="w-100 rounded-3" alt="Product Image">
            </section>
        </div>
        <div class="col-lg-7">
            <div class="mt-3">
                <section>
                    <h3>{{ $product->name }}</h3>
                    <h1 class="fw-bold text-danger">Rp {{ number_format($product->price, 0, ',', '.') }}</h1>
                </section>
                <form class="my-4" method="post">
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

    <div class="position-fixed end-0 bottom-0 pe-3 pb-3">
        <a href="{{ route('product-edit', ['id' => $product->id]) }}" class="btn btn-success">
            <i class="fa fa-edit"></i>
            Edit product
        </a>
    </div>

</x-template>
