<h3>Hi, {{ $user->name }}</h3>
<p>
    Thank you for your purchase! Your order has been successfully placed. Below are the details of your order:
</p>

<table border="1" style="width:100%">
    <thead>
        <tr>
            <th>Product</th>
            <th class="text-end">Price</th>
            <th class="text-end">Quantity</th>
            <th class="text-end">Subtotal</th>
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
            <td class="text-end">{{ $item->quantity }}</td>
            <td class="text-end">{{ number_format($subtotal, 0, 2, '.') }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="fw-bold">
        <tr>
            <td colspan="3">Total</td>
            <td class="text-end">{{ number_format($total, 0, 2, '.') }}</td>
        </tr>
    </tfoot>
</table>

<p>
    Please complete your payment in 1 hour.
</p>
<p>
    Thank you for shopping with us!<br/>
</p>
Best regards,<br/>
{{ config('app.name') }}