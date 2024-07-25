<x-template>
    <h1>Purchase history</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Time</th>
                <th>ID</th>
                <th>Total</th>
                <th>Payment status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->created_at }}</td>
                <td><a href="{{ route('invoice.view', ['id' => $invoice->id]) }}">{{ $invoice->id }}</a></td>
                <td>{{ number_format($invoice->total, 0, 2, '.') }}</td>
                <td>{{ $invoice->is_paid ? 'Paid' : 'Waiting payment' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-template>