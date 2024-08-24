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
                       <form action="{{route('slidereditpost',$slider_info->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slider Name</label>
                            <input type="text" class="form-control" placeholder="Enter Product Price" name="slider_name" value="{{$slider_info->slider_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slider Discription</label>
                            <input type="text" class="form-control" placeholder="Enter Product Price" name="slider_discription" value="{{$slider_info->slider_discription}}">
                        </div>

                       <div class="form-group">
                            <label for="exampleInputEmail1">Current Photo</label>
                            <br>
                          <img width="50" src="{{asset('uploads/slider')}}/{{$slider_info->slider_photo}}" alt="Not Fount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Photo</label>
                            <input type="file" class="form-control" name="slider_new_photo">
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
