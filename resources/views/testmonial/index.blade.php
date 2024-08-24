@extends('layouts.starlight')
@section('title')
Product
@endsection

@section('testmonial')
active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Tastmonial</span>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="row">
                            <div class="col-lg-6">Testmonial List</div>
                             <div class="col-lg-6 text-right">
                                <button id="testmonial_delete_all_btn" class="btn btn-danger">Delete All</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Testmonial Title</th>
                                <th scope="col">Testmonial Name</th>
                                <th scope="col">Testmonial Designation</th>
                                <th scope="col">Testmonial Photo</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($testmonials as $testmonial)
                                     <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$testmonial->testmonial_title}}</td>
                                        <td>{{$testmonial->testmonial_name}}</td>
                                        <td>{{$testmonial->testmonial_designation}}</td>
                                        <td>
                                             <img width="50" src="{{asset('uploads/testmonial')}}/{{$testmonial->testmonial_photo}}" alt="Not Fount">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('testmonialedit',$testmonial->id)}}" type="button" class="btn btn-secondary">Edit</a>
                                                <a href="{{route('testmonialdelete',$testmonial->id)}}" type="button" class="btn btn-warning">Delete</a>
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
                            <div class="col-lg-6">Delete Testmonial List</div>
                              <div class="col-lg-6 text-right">
                                 <a href="{{ route('testmonialallrestore') }}" type="button" class="btn btn-secondary">All Restore</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Testmonial Title</th>
                                <th scope="col">Testmonial Name</th>
                                <th scope="col">Testmonial Designation</th>
                                <th scope="col">Testmonial Photo</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($deleted_testmonials as $deleted_testmonial)
                                     <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$deleted_testmonial->testmonial_title}}</td>
                                        <td>{{$deleted_testmonial->testmonial_name}}</td>
                                        <td>{{$deleted_testmonial->testmonial_designation}}</td>
                                        <td>
                                             <img width="50" src="{{asset('uploads/testmonial')}}/{{$deleted_testmonial->testmonial_photo}}" alt="Not Fount">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('testmonialrestore',$deleted_testmonial->id)}}" type="button" class="btn btn-secondary">Restore</a>
                                                <a href="{{route('testmonialforcedelete',$deleted_testmonial->id)}}" type="button" class="btn btn-warning">Force Delete</a>
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
                    <div class="card-header text-white bg-secondary">Add Testmonial</div>
                    <div class="card-body">
                       <form action="{{route('testmonialpost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Testmonial Title</label>
                            <input type="text" class="form-control" placeholder="Enter Testmonial Title" name="testmonial_title">
                            {{-- @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Testmonial Short Discription</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="testmonial_short_discription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Testmonial Name</label>
                            <input type="text" class="form-control" placeholder="Enter Testmonial Name"name="testmonial_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Testmonial Designation</label>
                            <input type="text" class="form-control" placeholder="Enter Testmonial Designation" name="testmonial_designation">
                        </div>
                       <div class="form-group">
                            <label for="exampleInputEmail1">Testmonial Photo</label>
                            <input type="file" class="form-control" name="testmonial_photo">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add Testmonial Now</button>
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
        $('#testmonial_delete_all_btn').click(function(){
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
                 window.location.href = "testmonial/all/delete";
            }
            });
        });
    });
 </script>
@endsection
