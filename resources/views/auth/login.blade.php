@extends('layouts.admin')

@section('content')
<div class="container-login100" style="background-image: url('images/img-01.jpg');">
    <div class="wrap-login100 p-t-190 p-b-30">
        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="login100-form-avatar">
                <img src="{{ asset('images/avatar-01.jpg') }}" alt="AVATAR">
            </div>

            <span class="login100-form-title p-t-20 p-b-45">
                Login
            </span>

            <div class="wrap-input100 validate-input m-b-10 {{ $errors->has('email') ? ' has-error' : '' }}" data-validate = "Username is required">
                <input class="input100" type="text" name="username" placeholder="Username">
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
                <input class="input100" type="password" name="pass" placeholder="Password">
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

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <div class="container-login100-form-btn p-t-10">
                <button type="submit" class="login100-form-btn">
                    Login
                </button>
            </div>

            <div class="text-center w-full p-t-25 p-b-230">
                <a href="{{ route('password.request') }}" class="txt1" >
                    Forgot Username / Password?
                </a>
            </div>

            <div class="text-center w-full">
                <a class="txt1" href="#">
                    Create new account
                    <i class="fa fa-long-arrow-right"></i>						
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
