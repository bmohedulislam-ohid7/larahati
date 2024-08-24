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
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="row">
                            <div class="col-lg-6">Product List</div>
                             <div class="col-lg-6 text-right">
                                <button id="product_delete_all_btn" class="btn btn-danger">Delete All</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Product Alert Quantity</th>
                                <th scope="col">Added By</th>
                                <th scope="col">Product Photo</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                     <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{App\Models\Category::find($product->category_id)->category_name ?? 'none'}}</td>
                                        <td>{{$product->product_price}}</td>
                                        <td>{{$product->product_quantity}}</td>
                                        <td>{{$product->product_alert_quantity}}</td>
                                        <td>{{App\Models\User::find($product->user_id)->name}}</td>
                                        <td>
                                             <img width="50" src="{{asset('uploads/product')}}/{{$product->product_photo}}" alt="Not Fount">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('productedit',$product->id)}}" type="button" class="btn btn-secondary">Edit</a>
                                                <a href="{{route('productdelete',$product->id)}}" type="button" class="btn btn-warning">Delete</a>
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
                            <div class="col-lg-6">Delete Product List</div>
                              <div class="col-lg-6 text-right">
                                 <a href="{{ route('productallrestore') }}" type="button" class="btn btn-secondary">All Restore</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Product Alert Quantity</th>
                                <th scope="col">Added By</th>
                                <th scope="col">Product Photo</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($deleted_products as $deleted_product)
                                     <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$deleted_product->product_name}}</td>
                                        <td>{{App\Models\Category::find($deleted_product->category_id)->category_name ?? 'none'}}</td>
                                        <td>{{$deleted_product->product_price}}</td>
                                        <td>{{$deleted_product->product_quantity}}</td>
                                        <td>{{$deleted_product->product_alert_quantity}}</td>
                                        <td>{{App\Models\User::find($deleted_product->user_id)->name}}</td>
                                        <td>
                                             <img width="50" src="{{asset('uploads/product')}}/{{$deleted_product->product_photo}}" alt="Not Fount">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('productrestore',$deleted_product->id)}}" type="button" class="btn btn-secondary">Restore</a>
                                                <a href="{{route('productforcedelete',$deleted_product->id)}}" type="button" class="btn btn-warning">ForceDelete</a>
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
                    <div class="card-header text-white bg-secondary">Add Product</div>
                    <div class="card-body">
                       <form action="{{route('productpost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Category Name</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                            <option>- Chose One -</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach


                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name">
                            {{-- @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Price</label>
                            <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter Product Quantity" name="product_quantity">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Short Discription</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="product_short_discription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Long Discription</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="product_long_discription"></textarea>
                        </div>
                       <div class="form-group">
                            <label for="exampleInputEmail1">Product Alert Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter Product Quantity" name="product_alert_quantity">
                        </div>
                       <div class="form-group">
                            <label for="exampleInputEmail1">Product Photo</label>
                            <input type="file" class="form-control"  name="product_photo">
                        </div>
                       <div class="form-group">
                            <label for="exampleInputEmail1">Featured Photo</label>
                            <input type="file" class="form-control"  name="product_featured_photos[]" multiple>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add Product Now</button>
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
        $('#product_delete_all_btn').click(function(){
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
                 window.location.href = "product/all/delete";
            }
            });
        });
    });
 </script>
@endsection
