@extends('layouts.starlight')
@section('title')
Setting
@endsection

@section('setting')
active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Setting</span>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
          
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-white bg-secondary">Setting</div>
                    <div class="card-body">
                       <form action="{{route('settingpost')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" placeholder="Enter Product Name" name="phone" value="{{$settings->where('setting_name','phone')->first()->setting_value}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Enter Product Name" name="email" value="{{$settings->where('setting_name','email')->first()->setting_value}}">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update Setting</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
