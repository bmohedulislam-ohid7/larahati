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
                    <div class="card-header text-white bg-secondary">Edit Blog</div>
                    <div class="card-body">
                       <form action="{{route('blogeditpost',$blogedits->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                       <div class="form-group">
                            <label for="exampleInputEmail1">Current Photo</label>
                            <br>
                           <img width="200" src="{{asset('uploads/blog')}}/{{$blogedits->blog_photo}}" alt="Not Fount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Photo</label>
                            <input type="file" class="form-control" name="blog_new_photo">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Blog Title</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="blog_title">{{$blogedits->blog_title}}</textarea>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Blog Discription</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="blog_discription">{{$blogedits->blog_discription}}</textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Edit Blog Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
