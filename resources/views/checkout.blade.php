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
                        <li><a href="{{ route('tohoney_home') }}">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
@endsection
@section('body')
@auth
@if (Auth::user()->role == 2)
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
                    <form id="main_form" action="{{ route('checkoutpost') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p>Name *</p>
                                <input type="text" value="{{Auth::user()->name}}" name="customer_name">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" value="{{Auth::user()->email}}" name="customer_email">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text" name="customer_phone_number">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select id="country_list" name="customer_country_id">
                                    <option value="">--Select One--</option>
                                    @foreach ($countries as $country)
                                         <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>City *</p>
                                <select id="city_list" name="customer_city_id">
                                    <option value="">--Select One--</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Your Address *</p>
                                <input type="text" name="customer_address">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input type="text" name="customer_postcoe">
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="customer_massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        <li>Coupon Name <span class="pull-right"><strong>{{(session('session_coupon')) ? session('session_coupon') : "Not Aplicable"}}</li>
                        <li>Subtotal <span class="pull-right"><strong>${{session('session_subtotal')}}</li>
                        <li>Discount(%) <span class="pull-right"><strong>${{session('session_discount')}}</li>
                        <li>Total<span class="pull-right">${{session('session_total')}}</span></li>
                    </ul>
                    <ul class="payment-method">
                        <li>
                            <input id="card" type="radio" name="payment_option" value="1" checked>
                            <label for="card">Credit Card</label>
                        </li>
                        <li>
                            <input id="delivery" type="radio" name="payment_option" value="2">
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                    </ul>
                    <button type="button" id="place_order_btn">Place Order</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@else
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    You are an admin,you can not checkout.
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@else

@endauth

@endsection
@section("footer_scripts")
<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#country_list').select2();
    $('#city_list').select2();
    $('#country_list').change(function(){
        var country_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
        });
        $.ajax({
            type: 'POST',
            url: 'get/city/list',
            data: {country_id:country_id},
            success: function(data){
                $('#city_list').html(data);
            }
        });
    });
    $('#place_order_btn').click(function(){
        if($("input[name='payment_option']:checked").val() == 1){
             $('#main_form').attr('action','http://127.0.0.1:8000/pay');
        }
        else{
             $('#main_form').attr('action','http://127.0.0.1:8000/checkout/post');
        }
        $("#main_form").submit();
    });

});
</script>
@endsection
