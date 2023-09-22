@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>

    <!-- Displaying Cart Items -->
    <h3>Your Cart:</h3>
    <ul class="list-group mb-4">
        @foreach($variations as $variation)
            <li class="list-group-item">
                <strong>{{ $variation->product->name }} </strong> -   {{ $variation->size }},   {{ $variation->color }}
                <span class="float-right"><strong>{{$cart[$variation->id]}}</strong> x £{{$variation->price}} = £{{$variation->price * $cart[$variation->id] }}</span>
            </li>
        @endforeach
        <li class="list-group-item">
            <strong>Total:</strong>
            <span class="float-right">£{{ $totalPrice }}</span>
        </li>
    </ul>

    <!-- Address and User Information Form -->
    <form action="{{ route('checkout.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>

        <div class="mb-3">
            <label for="address1" class="form-label">Address 1:</label>
            <input type="text" class="form-control" id="address1" name="address1" required>
        </div>

        <div class="mb-3">
            <label for="address2" class="form-label">Address 2:</label>
            <input type="text" class="form-control" id="address2" name="address2">
        </div>

        <div class="mb-3">
            <label for="postcode" class="form-label">Post Code:</label>
            <input type="text" class="form-control" id="postcode" name="postcode" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City:</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Country:</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>

        <!-- Mock Credit Card Form -->
        <h4>Payment Information:</h4>
        <div class="mb-3">
            <label for="cardNumber" class="form-label">Card Number:</label>
            <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 1234 5678" required>
        </div>

        <!-- ... other fields for card expiry, CVV, etc. ... -->

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection
