@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(!empty($cart))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $details)
                    <tr>
                        <td><img src="{{ $details['image'] }}" width="50" height="50" class="img-fluid" /></td>
                        <td>{{ $details['name'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control" />
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                            </form>
                        </td>
                        <td>{{ number_format($details['price'], 0, ',', '.') }}</td>
                        <td>{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty!</p>
    @endif
</div>
@endsection
