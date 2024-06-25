@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Checkout</h2>

    @if(!empty($cart))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $details)
                    <tr>
                        <td><img src="{{ $details['image'] }}" width="50" height="50" class="img-fluid" /></td>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>{{ number_format($details['price'], 0, ',', '.') }}</td>
                        <td>{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
        </div>
    @else
        <p>Your cart is empty!</p>
    @endif
</div>
@endsection
