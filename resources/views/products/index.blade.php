@extends('layouts.app')

@section('content')
<style>
    .card-text {
    height: 100px; /* Or whatever fixed height you desire */
    overflow-y: auto; /* This will add a scrollbar if the content exceeds the fixed height */
}
form {
    display: inline-block;
    float: right;
} 
    li{
        padding-top: 30px;
    }

</style>
<div class="container">
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 col-sm-12">
                <div class="card mb-4">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <hr>
                        <h6>Variations:</h6>
                        <ul>
                        @foreach($product->variations as $variation)
                            <li>
                                £{{ $variation->price }} ({{ $variation->size }}, {{ $variation->color }})         
                                <form action="{{ route('cart.add', $variation->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm  btn-primary">Add <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                            </form>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection