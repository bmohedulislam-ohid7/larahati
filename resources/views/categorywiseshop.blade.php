@extends('layouts.tohoney')
@section('breadcumb')
 <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="{{route('tohoney_home')}}">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->   
@endsection
@section('body')
<!-- product-area start -->
<div class="product-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2> {{$categories->category_name}}</h2>
                    <img src="{{asset('tohoney_assets')}}/images/section-title.png" alt="">
                </div>
            </div>
            <div class="col-lg-12">
                <ul class="row">
            @foreach ( $products as $product)
                    @include('little_part.allproduct')
            @endforeach
        </ul>
            </div>
        </div>
    </div>
</div>
@endsection