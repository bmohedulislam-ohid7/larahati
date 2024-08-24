@extends('layouts.tohoney')
@section('breadcumb')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Account</h2>
                    <ul>
                        <li><a href="{{ route('tohoney_home') }}">Home</a></li>
                        <li><span>Login</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
@endsection
@section('body')
<!-- checkout-area start -->
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <form action="{{ route('customerloginpost') }}" method="post">
                    @csrf
                    <div class="account-form form-style">
                        <p>Email Address *</p>
                        <input type="email" name="email">
                        <p>Password *</p>
                        <input type="Password" name="password">
                         @if (session('cus_login_error'))
                             <span class="text-danger">
                                {{ session('cus_login_error') }}
                             </span>
                        @endif
                        <button>LOGIN</button>
                        <div class="text-center">
                            <a href="{{ route('customerregister') }}">Or Creat an Account</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection
