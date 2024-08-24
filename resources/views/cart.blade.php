@extends('layouts.tohoney')
@section('breadcumb')
 <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="{{route('tohoney_home')}}">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
@endsection
@section('body')
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('updatecart')}}" method="POST">
                    @csrf
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                             @php
                                $flag = false;
                                $subtotal = 0;
                            @endphp
                            @forelse ($carts as $cart)
                                <tr>
                                    <td class="images"><img width="50" src="{{asset('uploads/product')}}/{{$cart->relationtoproducttable->product_photo}}" alt=""></td>
                                    <td class="product">
                                        {{$cart->relationtoproducttable->product_name}}
                                        {{$cart->relationtoproducttable->product_quantity}}
                                       @if ($cart->relationtoproducttable->product_quantity < $cart->quantity)
                                           <span class="badge badge-danger">Available Stock:{{$cart->relationtoproducttable->product_quantity}}</span>
                                           @php
                                              $flag = true;
                                           @endphp
                                       @endif
                                    </td>
                                    <td class="price">${{$cart->relationtoproducttable->product_price}}</td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" value="{{$cart->quantity}}" name="quantity[{{$cart->id}}]"/>
                                    </td>
                                    <td class="total">
                                        @php
                                            $subtotal += ($cart->relationtoproducttable->product_price * $cart->quantity);
                                        @endphp
                                    </td>
                                    <td class="remove">
                                        <a href="{{route('cartdelete',$cart->id)}}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100">
                                        No Data to Show
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li>
                                        <button type="submit">Update Cart</button>
                                    </li>
                                    <li><a href="shop.html">Continue Shopping</a></li>
                                </ul>
                                <h3>Coupon</h3>
                                <p>Enter Your Coupon Code if You Have One</p>
                                <div class="coupon-wrap">
                                    <input type="text" placeholder="Coupon Code" id="apply_coupon_input">
                                    <button id="apply_coupon_btn" class="btn-sm btn btn-danger" type="button">Apply Coupon</button>
                                    @if (session('coupon_error'))
                                         <div class="alert alert-danger mt-3">
                                            {{session('coupon_error')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left">Subtotal </span>${{$subtotal}}</li>
                                    <li><span class="pull-left"> Discount(%) </span>{{$coupon_discount}}</li>
                                    <li><span class="pull-left"> Total </span> ${{$subtotal-($coupon_discount/100 * $subtotal)}}</li>
                                    @php
                                        session([
                                            'session_coupon'=> $coupon_name,
                                            'session_subtotal'=> $subtotal,
                                            'session_discount'=> $coupon_discount,
                                            'session_total'=> $subtotal-($coupon_discount/100 * $subtotal)
                                        ]);
                                    @endphp
                                </ul>
                                @if ($flag)
                                    <a href="checkout.html">Problem ase</a>
                                @else
                                    <a href="{{route('checkout')}}">Proceed to Checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->
@endsection
@section('footer_scripts')
  <script>
      $(document).ready(function(){
        $('#apply_coupon_btn').click(function(){
            var coupon_name = $('#apply_coupon_input').val();
            var link_to_go = "{{route('cart')}}/" + coupon_name;
            window.location.href = link_to_go;
        });
    });
  </script>
@endsection


