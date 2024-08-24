@extends('layouts.tohoney')
@section('breadcumb')
 <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Search Page</h2>
                        <ul>
                            <li><a href="{{route('tohoney_home')}}">Home</a></li>
                            <li><span>Search</span></li>
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
           @forelse ( $searched_products as $product)
                @include('little_part.allproduct')
            @empty
            <div class="col-12">
                <div class="alert alert-danger text-center">
                    No product to show
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
<!-- product-area end -->
@endsection

