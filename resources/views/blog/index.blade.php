@extends('layouts.starlight')
@section('title')
Blog
@endsection

@section('blog')
active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Blog</span>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="row">
                            <div class="col-lg-6">Blog List</div>
                             <div class="col-lg-6 text-right">
                                <button id="blog_delete_all_btn" class="btn btn-danger">Delete All</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Blog Photo</th>
                                <th scope="col">Blog Title</th>
                                <th scope="col">Blog Discription</th>
                                <th scope="col">Added By</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bloginfos as $bloginfo)
                                     <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>
                                             <img width="50" src="{{asset('uploads/blog')}}/{{$bloginfo->blog_photo}}" alt="Not Fount">
                                        </td>
                                          <td>{{$bloginfo->blog_title}}</td>
                                        <td>{{$bloginfo->blog_discription}}</td>
                                        <td>{{App\Models\User::find($bloginfo->user_id)->name}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('blogedit',$bloginfo->id)}}" type="button" class="btn btn-secondary">Edit</a>
                                                <a href="{{route('blogdelete',$bloginfo->id)}}" type="button" class="btn btn-warning">Delete</a>
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
                            <div class="col-lg-6">Deleted Blog List</div>
                              <div class="col-lg-6 text-right">
                                 <a href="{{ route('blogallrestore') }}" type="button" class="btn btn-secondary">All Restore</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Blog Photo</th>
                                <th scope="col">Blog Title</th>
                                <th scope="col">Blog Discription</th>
                                <th scope="col">Added By</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($deleted_blogs as $deleted_blog)
                                     <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>
                                             <img width="50" src="{{asset('uploads/blog')}}/{{$deleted_blog->blog_photo}}" alt="Not Fount">
                                        </td>
                                          <td>{{$deleted_blog->blog_title}}</td>
                                        <td>{{$deleted_blog->blog_discription}}</td>
                                        <td>{{App\Models\User::find($deleted_blog->user_id)->name}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('blogrestore',$deleted_blog->id)}}" type="button" class="btn btn-secondary">Restore</a>
                                                <a href="{{route('blogforcedelete',$deleted_blog->id)}}" type="button" class="btn btn-warning">Force Delete</a>
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
                    <div class="card-header text-white bg-secondary">Add Blog</div>
                    <div class="card-body">
                       <form action="{{route('blogpost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Blog Photo</label>
                            <input type="file" class="form-control"  name="blog_photo">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Blog Title</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="blog_title"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Blog Discription</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="blog_discription"></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add Blog Now</button>
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
        $('#blog_delete_all_btn').click(function(){
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
                 window.location.href = "blog/all/delete";
            }
            });
        });
    });
 </script>
@endsection

