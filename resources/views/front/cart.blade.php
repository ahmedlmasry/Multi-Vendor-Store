@php use App\Helpers\Currency; @endphp
@extends('front.master')
@section('content')

    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="/"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="/">Shop</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        <div class="cart-list-head">
            <!-- Cart List Title -->
            <div class="cart-list-title">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-12">
                    </div>
                    <div class="col-lg-4 col-md-3 col-12">
                        <p>Product Name</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>Quantity</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>Subtotal</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>Discount</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-12">
                        <p>Remove</p>
                    </div>
                </div>
            </div>
            <!-- End Cart List Title -->
            <!-- Cart Single List list -->
            @foreach($cart->get() as $item )
                <div class="cart-single-list " id="{{ $item->id }}">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="{{url('product/'.$item->slug)}}"><img
                                    src="{{$item->product->image_url}}" alt="#"></a>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <h5 class="product-name"><a href="product-details.html">
                                    {{$item->product->name}}</a></h5>
                            <p class="product-des">
                                <span><em>Type:</em> {{$item->product->category->name}}</span>
                                <span><em>Color:</em> Black</span>
                            </p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="count-input">
                                <input data-id="{{$item->id}}" class="form-control item-quantity"
                                       value="{{$item->quantity}}">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{Currency::format($item->product->price)}}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>$29.00</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <a data-id="{{$item->id}}" class="remove-item" href="javascript:void(0)"><i
                                    class="lni lni-close"></i></a>
                        </div>
                    </div>
                </div>
                <!-- End Single List list -->
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-12">
                            <div class="left">
                                <div class="coupon">
                                    <form action="#" target="_blank">
                                        <input name="Coupon" placeholder="Enter Your Coupon">
                                        <div class="button">
                                            <button class="btn">Apply Coupon</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="right">
                                <ul>
                                    <li>Cart Subtotal<span>$2560.00</span></li>
                                    <li>Shipping<span>Free</span></li>
                                    <li>You Save<span>$29.00</span></li>
                                    <li class="last">You Pay<span>$2531.00</span></li>
                                </ul>
                                <div class="button">
                                    <a href="{{route('checkout')}}" class="btn">Checkout</a>
                                    <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
    </div>
</div>
<!--/ End Shopping Cart -->

@endsection
@push('scripts')
    <script>
        (function ($) {
            $('.item-quantity').change(function (e) {
                // alert('sds');
                e.preventDefault();
                $.ajax({
                    url: '/carts/' + $(this).data('id'),
                    method: 'put',
                    data: {
                        quantity: $(this).val(),
                        _token: "{{csrf_token()}}"
                    }

                });
            });
        })(jQuery);
    </script>
    <script>
        (function ($) {
            $('.remove-item').click(function (e) {
                e.preventDefault();
                let id = $(this).data('id')
                $.ajax({
                    url: '/carts/' + id,
                    method: 'delete',
                    data: {
                        _token: "{{csrf_token()}}"
                    },
                    success: function (data){
                        $(`#${id}`).remove();
                    }

                });
            });
        })(jQuery);
    </script>
@endpush
