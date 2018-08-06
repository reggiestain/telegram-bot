@extends('layouts.app')
@section('content')
<div class="container-login100" style="background-image: url('images/img-01.jpg');">
    <div class="wrap-login100 p-t-190 p-b-30">
        <form class="login100-form validate-form" method="POST" action="{{ route('login.post') }}">
            {{ csrf_field() }}
            <!--<div class="login100-form-avatar">
                <img src="{{ asset('images/avatar-01.jpg') }}" alt="AVATAR">
            </div>-->
            <span class="login100-form-title p-t-20 p-b-45">
                Login
            </span>
            @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ session('success') }}</strong> 
            </div>
            @endif
            @if (session('danger'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ session('danger') }}</strong> 
            </div>
            @endif

            <div class="wrap-input100 validate-input m-b-10 {{ $errors->has('email') ? ' has-error' : '' }}" data-validate = "Username is required">
                <input class="input100" type="text" name="email" placeholder="Email">
                @if ($errors->has('email'))
                <span class="error text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-user"></i>
                </span>
            </div>

            <div class="wrap-input100 validate-input m-b-10 {{ $errors->has('password') ? ' has-error' : '' }}" data-validate = "Password is required">
                <input class="input100" type="password" name="password" placeholder="Password">
                @if ($errors->has('password'))
                <span class="error text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-lock"></i>
                </span>
            </div>

            <div class="container-login100-form-btn p-t-10">
                <button type="submit" class="login100-form-btn">
                    Login
                </button>
            </div>

            <div class="text-center w-full p-t-25 p-b-230">
                <a class="txt1" href="{{route('register')}}">
                    Create new account
                    <i class="fa fa-long-arrow-right"></i>						
                </a>
            </div>

            <!--<div class="text-center w-full">
                <a class="txt1" href="#">
                    Create new account
                    <i class="fa fa-long-arrow-right"></i>						
                </a>
            </div>-->
        </form>
    </div>
</div>
@endsection
