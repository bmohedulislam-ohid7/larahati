@extends('layouts.starlight')
@section('title')
Category
@endsection

@section('category')
active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Category</span>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="row">
                            <div class="col-lg-6">Category List</div>
                            <div class="col-lg-6 text-right">
                                <button id="delete_all_btn" class="btn btn-danger">Delete All</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Delete?</th>
                                <th scope="col">SL No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category Photo</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                     <tr>
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td>
                                            <img width="50" src="{{asset('uploads/category')}}/{{$category->category_photo}}" alt="Not Fount">
                                        </td>
                                        <td>{{$category->created_at->format('d/m/Y')}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{url('category/edit')}}/{{$category->id}}" type="button" class="btn btn-primary">Edit</a>
                                                <a href="{{url('category/delete')}}/{{$category->id}}" type="button" class="btn btn-warning">Delete</a>
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
                        <button class="btn btn-info text-white">Check all</button>
                    </div>
                </div>
                <br>
                <br>
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="row">
                            <div class="col-lg-6">Deleted Category List</div>
                            <div class="col-lg-6 text-right">
                                 <a href="{{ route('categoryallrestore') }}" type="button" class="btn btn-secondary">All Restore</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category Photo</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($deleted_categories as $deleted_category)
                                     <tr>
                                        <th scope="row">{{$loop->index+1}}</th>
                                        <td>{{$deleted_category->category_name}}</td>
                                        <td>
                                            <img width="50" src="{{asset('uploads/category')}}/{{$deleted_category->category_photo}}" alt="Not Fount">
                                        </td>
                                        <td>{{$deleted_category->created_at->format('d/m/Y')}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{url('category/restore')}}/{{$deleted_category->id}}" type="button" class="btn btn-secondary">Restore</a>
                                                <a href="{{url('category/force/delete')}}/{{$deleted_category->id}}" type="button" class="btn btn-danger">Force Delete</a>
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
                    <div class="card-header text-white bg-secondary">Add Category</div>
                    <div class="card-body">
                       <form action="{{url('category/post')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name">
                            @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Category Photo</label>
                            <input type="file" class="form-control" name="category_photo">
                        </div>
                        @if (session('category_insert_status'))
                            <br>
                             <div class="alert alert-success">
                            {{session('category_insert_status')}}
                        </div>
                        @endif
                        @if (session('category_delete_status'))
                            <br>
                             <div class="alert alert-success">
                            {{session('category_delete_status')}}
                        </div>
                        @endif
                        <br>
                        <button type="submit" class="btn btn-primary">Add Category Now</button>
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
                 window.location.href = "category/all/delete";
            }
            });
        });
    });
 </script>
@endsection
