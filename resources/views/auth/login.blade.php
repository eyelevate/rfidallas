@extends('layouts.frontend')

@section('header')
<br/><br/>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="card card-signup" data-background-color="orange">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="header header-primary text-center">
                    <h4 class="title title-up">Login</h4>
                    <div class="social-line">
                        <a href="#pablo" class="btn btn-neutral btn-facebook btn-icon btn-icon-mini">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                        <a href="#pablo" class="btn btn-neutral btn-twitter btn-icon">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#pablo" class="btn btn-neutral btn-google btn-icon  btn-icon-mini">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="content">

                    <div class="input-group form-group-no-border {{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="now-ui-icons ui-1_email-85" style="padding-right:3px;"></i>
                        </span>
                        <input id="email" placeholder="Email Address" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>           
                    @if ($errors->has('email'))
                        <div class="col-12">
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        </div>
                    @endif
                    

                    <div class="input-group form-group-no-border {{ $errors->has('password') ? ' has-error' : '' }}">
                        <span class="input-group-addon" style="padding-right:3px;">
                            <i class="now-ui-icons ui-1_lock-circle-open"></i>
                        </span>
                        <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>
                    </div>
                    @if ($errors->has('password'))
                        <div class="col-12">
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        </div>
                    @endif

                    <div class="col-12">

                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
  
                    </div>
                    
                </div>
                <div class="footer text-center">
                    <button type="submit" class="btn btn-neutral btn-round btn-lg">
                        Login
                    </button>

                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
