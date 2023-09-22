@extends('layouts.app')

@section('content')

<div class="container">
@if(session('cart') && count(session('cart')) > 0)
    <h3>Your Shopping Cart</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Product Image</th>
                <th>Variation Details</th>
                <th>Quantity</th>
                <th>Price</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($variations as $variation)
                <tr>
                    <td><img src="{{ $variation->product->image }}" width="50"></td>
                    <td>
                        {{ $variation->product->name }} - 
                        {{ $variation->size }}, {{ $variation->color }} 
                        (£{{ $variation->price }})
                    </td>
                    <td>{{ $cart[$variation->id] }}</td>
                    <td>£{{ $variation->price * $cart[$variation->id] }}</td>
                    <td>
                    <form action="{{ route('cart.remove', $variation->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td><h6>£{{ $totalPrice }}</h6></td>
                <td></td>
        </tbody>
    </table>


<div class="d-flex justify-content-between mt-3">
    <!-- Continue Shopping Button -->
    <a href="{{ route('products.index') }}" class="btn btn-light">Continue Shopping</a>
    
    <!-- Proceed to Checkout Button -->
    <a href="{{ route('checkout.index') }}" disabled="disabled" class="btn btn-primary">Checkout </a>
    
</div>

@else
    <div class="alert alert-info">Your cart is empty.</div>
    <a href="{{ route('products.index') }}" class="btn btn-light mt-3">Start Shopping</a>
@endif

</div>
@endsection