@extends('layouts.tohoney')
@section('breadcumb')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Blog Page</h2>
                    <ul>
                        <li><a href="{{route('tohoney_home')}}">Home</a></li>
                        <li><span>Blog</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
@endsection
@section('body')
<!-- blog-area start -->
    <div class="blog-area">
        <div class="container">
            <div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>Latest News</h2>
                    <img src="{{asset('tohoney_assets')}}/images/section-title.png" alt="">
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-lg-4  col-md-6 col-12">
                    <div class="blog-wrap">
                        <div class="blog-image">
                            <img src="{{asset('uploads/blog')}}/{{$blog->blog_photo}}" alt="Not Fount">
                            <ul>
                                <li>{{ $blog->created_at->format('d') }}</li>
                                <li>{{ $blog->created_at->format('M') }}</li>
                            </ul>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <ul>
                                    <li><a href="#"><i class="fa fa-user"></i> {{App\Models\User::find($blog->user_id)->name}}</a></li>
                                    <li class="pull-right"><a href="#"><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('d/m/Y') }}</a></li>
                                </ul>
                            </div>
                            <h3><a href="blog-details.html">{{ $blog->blog_title }}</a></h3>
                            <p>{{ $blog->blog_discription }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12">
                    <div class="pagination-wrapper text-center mb-30">
                        <ul class="page-numbers">
                            <li><a class="prev page-numbers" href="#"><i class="fa fa-arrow-left"></i></a></li>
                            <li><span class="page-numbers current">1</span></li>
                            <li><a class="page-numbers" href="#">2</a></li>
                            <li><a class="page-numbers" href="#">3</a></li>
                            <li><a class="next page-numbers" href="#"><i class="fa fa-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-area end -->
@endsection
