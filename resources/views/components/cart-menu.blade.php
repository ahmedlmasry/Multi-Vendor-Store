@php use App\Facades\Cart;use App\Helpers\Currency; @endphp
<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items">{{$carts->count()}}</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{$carts->count()}} Items</span>
            <a href="{{route('carts.index')}}">View Cart</a>
        </div>
        @foreach($carts->all() as $item)
            <ul class="shopping-list">
                <li>
                    <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                            class="lni lni-close"></i></a>
                    <div class="cart-img-head">
                        <a class="cart-img" href="{{url('product/'.$item->product->slug)}}"><img
                                src="{{$item->product->image_url}}" alt="#"></a>
                    </div>
                    <div class="content">
                        <h4><a href="{{url('product/'.$item->product->slug)}}">
                                {{$item->product->name}}</a></h4>
                        <p class="quantity">1x - <span
                                class="amount">{{Currency::format($item->product->price)}}</span>
                        </p>
                    </div>
                </li>

            </ul>
        @endforeach
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">{{Currency::format(Cart::total())}}</span>
            </div>
            <div class="button">
                <a href="{{route('checkout')}}" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>
