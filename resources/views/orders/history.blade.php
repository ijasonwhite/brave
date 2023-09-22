@extends('layouts.app')

@section('content')
<div class="container">

    @if($orders->isEmpty())
        <p>No orders have been placed yet.</p>
    @else

    <div class="container mt-5">
    @foreach($orders as $order)
        <div class="row border-bottom py-3">
            
            <!-- Summary Section -->
            <div class="col-md-4">
                <h5>Order Date: {{ $order->created_at->format('d-m-Y H:i') }}</h5>
                <p>Total Price: £{{ number_format($order->total, 2) }}</p>
            </div>

            <!-- Product Variation Details -->
            <div class="col-md-4">
                <h6>Products:</h6>
                @foreach($order->orderItems as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->productVariation->product->name  }} {{ $item->productVariation->SKU  }}</h5>
                            <p class="card-text"><strong>Price:</strong> £{{ number_format($item->price, 2) }}</p>
                            <p class="card-text"><strong>Quantity:</strong> {{ $item->quantity }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Delivery Details -->
            <div class="col-md-4">
                <h6>Delivery Details:</h6>
                <p><strong>Name:</strong> {{ $order->firstname }} {{ $order->lastname }}</p>
                <p><strong>Address 1:</strong> {{ $order->address1 }}</p>
                @if($order->address2)
                    <p><strong>Address 2:</strong> {{ $order->address2 }}</p>
                @endif
                <p><strong>Postcode:</strong> {{ $order->postcode }}</p>
                <p><strong>City:</strong> {{ $order->city }}</p>
                <p><strong>Country:</strong> {{ $order->country }}</p>
            </div>

        </div>
    @endforeach
</div>


    @endif
</div>
@endsection
