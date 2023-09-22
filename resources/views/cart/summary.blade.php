
        <div class="cart-display" style="margin-right:20px;">
        <a href="{{ route('cart.index') }}" class="btn btn-secondary btn-sm">View <i class="fa fa-shopping-cart" aria-hidden="true"></i> 

            @if(session('cart') && count(session('cart')) > 0)
                £{{ session('cart_total_price') }}
            @else
                £0.00
            @endif
        </a>
        </div>
