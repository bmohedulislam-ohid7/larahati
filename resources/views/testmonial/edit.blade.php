@extends('layouts.starlight')
@section('title')
Testmonial
@endsection

@section('testmonial')
active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Testmonial</span>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 m-auto">
                <div class="card">
                    <div class="card-header text-white bg-secondary">Add Testmonial</div>
                    <div class="card-body">
                       <form action="{{route('testmonialeditpost',$testmonial_info->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Testmonial Title</label>
                            <input type="text" class="form-control" placeholder="Enter Testmonial Title" name="testmonial_title" value="{{ $testmonial_info->testmonial_title }}">
                            {{-- @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Testmonial Short Discription</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="testmonial_short_discription">{{ $testmonial_info->testmonial_short_discription }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Testmonial Name</label>
                            <input type="text" class="form-control" placeholder="Enter Testmonial Name"name="testmonial_name" value="{{ $testmonial_info->testmonial_name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Testmonial Designation</label>
                            <input type="text" class="form-control" placeholder="Enter Testmonial Designation" name="testmonial_designation" value="{{ $testmonial_info->testmonial_designation }}">
                        </div>

                       <div class="form-group">
                            <label for="exampleInputEmail1">Current Photo</label>
                            <br>
                          <img width="50" src="{{asset('uploads/testmonial')}}/{{$testmonial_info->testmonial_photo}}" alt="Not Fount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Photo</label>
                            <input type="file" class="form-control" name="testmonial_new_photo">
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
