@extends('layouts.starlight')
@section('title')
Product
@endsection

@section('product')
active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Product</span>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 m-auto">
                <div class="card">
                    <div class="card-header text-white bg-secondary">Add Product</div>
                    <div class="card-body">
                       <form action="{{route('producteditpost',$product_info->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Category Name</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                            <option>- Chose One -</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"{{($product_info->category_id == $category->id )? 'selected':''}}>{{$category->category_name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="hidden" class="form-control" placeholder="Enter Product Name" name="product_id" value="{{$product_info->id}}">
                            <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="{{$product_info->product_name}}">
                            {{-- @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Price</label>
                            <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price" value="{{$product_info->product_price}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter Product Quantity" name="product_quantity" value="{{$product_info->product_quantity}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Short Discription</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="product_short_discription">{{$product_info->product_short_discription}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Long Discription</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="product_long_discription">{{$product_info->product_long_discription}}</textarea>
                        </div>
                       <div class="form-group">
                            <label for="exampleInputEmail1">Product Alert Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter Product Quantity" name="product_alert_quantity" value="{{$product_info->product_alert_quantity}}">
                        </div>
                       <div class="form-group">
                            <label for="exampleInputEmail1">Current Photo</label>
                            <br>
                           <img width="200" src="{{asset('uploads/product')}}/{{$product_info->product_photo}}" alt="Not Fount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Photo</label>
                            <input type="file" class="form-control" name="product_new_photo">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Edit Product Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
