<x-template>
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('invoice.list') }}" class="btn btn-secondary">Back</a>
        </div>
        <h1>Invoice {{ $invoice->id }}</h1>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Quantity</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-end">{{ number_format($item->product->price, 0, 2, '.') }}</td>
                    <td class="text-end">{{ $item->quantity }}</td>
                    <td class="text-end">{{ number_format($item->quantity * $item->product->price, 0, 2, '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="fw-bold">
                <tr>
                    <td colspan="3">Total</td>
                    <td class="text-end">{{ number_format($invoice->total, 0, 2, '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</x-template>