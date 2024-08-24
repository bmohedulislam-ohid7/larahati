@extends('layouts.starlight')
@section('title')
Product
@endsection

@section('slider')
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
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="row">
                            <div class="col-lg-6">Slider List</div>
                            <div class="col-lg-6 text-right">
                                <button id="delete_all_btn" class="btn btn-danger">Delete All</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Slider Name</th>
                                    <th scope="col">Slider Discription</th>
                                    <th scope="col">Slider Photo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sliders as $slider)
                                    <tr>
                                        <th>{{ $loop->index+1 }}</th>
                                        <th>{{ $slider->slider_name }}</th>
                                        <th>{{ $slider->slider_discription }}</th>
                                        <th> <img width="50" src="{{asset('uploads/slider')}}/{{$slider->slider_photo}}" alt="Not Fount"></th>
                                         <td>
                                             <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('slideredit',$slider->id) }}" type="button" class="btn btn-primary">Edit</a>
                                                <a href="{{ route('sliderdelete',$slider->id) }}" type="button" class="btn btn-warning">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                <tr class="text-center text-danger">
                                    <td colspan="50">
                                        No Data TO Show
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            </table>
                    </div>
                </div>
                 <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="row">
                            <div class="col-lg-6">Deleted Slider List</div>
                            <div class="col-lg-6 text-right">
                                 <a href="{{ route('sliderallrestore') }}" type="button" class="btn btn-secondary">All Restore</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Slider Name</th>
                                    <th scope="col">Slider Discription</th>
                                    <th scope="col">Slider Photo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse ($deleted_sliders as $deleted_slider)
                                    <tr>
                                        <th>{{ $loop->index+1 }}</th>
                                        <th>{{ $deleted_slider->slider_name }}</th>
                                        <th>{{ $deleted_slider->slider_discription }}</th>
                                        <th> <img width="50" src="{{asset('uploads/slider')}}/{{$deleted_slider->slider_photo}}" alt="Not Fount"></th>
                                         <td>
                                             <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('sliderrestore',$deleted_slider->id) }}" type="button" class="btn btn-primary">Restore</a>
                                                <a href="{{ route('sliderforcedelete',$deleted_slider->id) }}" type="button" class="btn btn-warning">Force Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                <tr class="text-center text-danger">
                                    <td colspan="50">
                                        No Data TO Show
                                    </td>
                                </tr>
                                 @endforelse
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-white bg-secondary">Add Slider</div>
                    <div class="card-body">
                       <form action="{{route('sliderpost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slider Name</label>
                            <input type="text" class="form-control" placeholder="Enter Slider Name" name="slider_name">
                            {{-- @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slider Discription</label>
                           <textarea class="form-control" rows="3" name="slider_discription"></textarea>
                        </div>
                       <div class="form-group">
                            <label for="exampleInputEmail1">Slider Photo</label>
                            <input type="file" class="form-control"  name="slider_photo">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add Slider Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
 <script>
    $(document).ready(function(){
        $('#delete_all_btn').click(function(){
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                 window.location.href = "slider/all/delete";
            }
            });
        });
    });
 </script>
@endsection
