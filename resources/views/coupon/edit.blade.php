@extends('layouts.starlight')
@section('title')
Coupon
@endsection

@section('coupon')
active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Coupon</span>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 m-auto">
                <div class="card">
                    <div class="card-header text-white bg-secondary">Edit Coupon</div>
                    <div class="card-body">
                       <form action="{{route('coupon.update',$coupon->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Coupon Name</label>
                            <input type="text" class="form-control" placeholder="Enter Coupon Name" name="coupon_name" value="{{$coupon->coupon_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Discount Amount</label>
                            <input type="text" class="form-control" placeholder="Enter Discount Amount" name="discount_amount" value="{{$coupon->discount_amount}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Expire Date</label>
                            <input type="date" class="form-control" placeholder="Enter Expire Date" name="expire_date" value="{{$coupon->expire_date}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Uses Limit</label>
                            <input type="text" class="form-control" placeholder="Enter Uses Limit" name="uses_limit" value="{{$coupon->uses_limit}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Coupon Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

