@extends('layouts.starlight');

@section('title')
{{$category_info->category_name}} - Edit Category
@endsection

@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <a class="breadcrumb-item" href="{{url('category')}}">Category</a>
        <span class="breadcrumb-item active">Edit</span>
    </nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header text-white bg-secondary">Edit Category</div>
                <div class="card-body">
                    <form action="{{url('category/edit/post')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="hidden" name="category_id" value="{{$category_info->id}}">
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{$category_info->category_name}}">
                        @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    @if (session('category_same_data_error'))
                        <span class="text-danger">
                            {{session('category_same_data_error')}}
                        </span>
                    @endif
                    <br>
                    <button type="submit" class="btn btn-primary">Edit Category Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection