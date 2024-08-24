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
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="row">
                            <div class="col-lg-6">Coupon List</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Coupon Name</th>
                                    <th scope="col">Discount Amount</th>
                                    <th scope="col">Expire Date</th>
                                    <th scope="col">Uses Limit</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                     <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$coupon->coupon_name}}</td>
                                        <td>{{$coupon->discount_amount}}</td>
                                        <td>{{$coupon->expire_date}}</td>
                                        <td>{{$coupon->uses_limit}}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{route('coupon.edit',$coupon->id)}}">Edit</a>
                                            <form  action="{{route('coupon.destroy',$coupon->id)}}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-white bg-secondary">Add Coupon</div>
                    <div class="card-body">
                       <form action="{{route('coupon.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Coupon Name</label>
                            <input type="text" class="form-control" placeholder="Enter Coupon Name" name="coupon_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Discount Amount</label>
                            <input type="text" class="form-control" placeholder="Enter Discount Amount" name="discount_amount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Expire Date</label>
                            <input type="date" class="form-control" placeholder="Enter Expire Date" name="expire_date">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Uses Limit</label>
                            <input type="text" class="form-control" placeholder="Enter Uses Limit" name="uses_limit">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Coupon Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

