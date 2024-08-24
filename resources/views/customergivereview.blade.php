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
                            <div class="col-lg-6">Give Review</div>

                        </div>
                    </div>
                    <div class="card-body">
                        @forelse ($order_details as $order_detail)
                        @if (App\Models\Review::where('order_details_id', $order_detail->id)->exists())
                        done
                        @else
                         <div class="card">
                                <div class="card-header">
                                    {{ App\Models\Product::find($order_detail->product_id)->product_name }}
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('reviewpost',$order_detail->id) }}" method="POST">
                                        @csrf
                                        <input type="text" name="review_text" class="form-control">
                                        <br>
                                        <input type="range" id="points" name="stars" min="1" max="5" value="1">
                                        <br>
                                        <button type="submit" class="btn btn-success">Give Review</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                        @empty
                        nai
                        @endforelse
                    </div>
                </div>
                <br>
                <br>

            </div>

        </div>
    </div>
@endsection

