<x-template>
    <div class="container">
        <h1>Shopping cart</h1>
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-end">Price</th>
                    <th class="text-end" style="width:200px">Quantity</th>
                    <th class="text-end">Subtotal</th>
                    <th style="width:50px"></th>
                </tr>
            </thead>
            <tbody>
                @php
                $total = 0;
                @endphp
                @foreach ($items as $item)
                @php
                $subtotal = $item->quantity * $item->product->price;
                $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-end">{{ number_format($item->product->price, 0, 2, '.') }}</td>
                    <td class="text-end">
                        <form method="post" action="{{ route('cart.edit', ['cart_id' => $item->id]) }}">
                            @csrf
                            <div class="input-group">
                                <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                    <td class="text-end">{{ number_format($subtotal, 0, 2, '.') }}</td>
                    <td>
                        <form method="post" action="{{ route('cart.delete', ['cart_id' => $item->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="fw-bold">
                <tr>
                    <td colspan="3">Total</td>
                    <td class="text-end">{{ number_format($total, 0, 2, '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        @if($items->isNotEmpty())
        <form method="post" action="{{ route('invoice.create') }}">
            @csrf
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-lg">Checkout</button>
            </div>
        </form>
        @endif
    </div>
</x-template>