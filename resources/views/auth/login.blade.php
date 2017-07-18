@extends('layouts.frontend')

@section('styles')

@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/auth/login.js') }}"></script>
@endsection

@section('header')
<br/><br/>
@endsection

@section('content')

<div class="row">
    <bootstrap-card class="card-signup" data-background-color="orange">
        <template slot="header"></template>
        <template slot="body">
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
                <!-- Email -->
                    <now-input class="form-group-no-border {{ $errors->has('email') ? ' has-danger' : '' }}" 
                        b-icon="ion-email" 
                        b-placeholder="Email Address"
                        b-name="email"
                        b-type="email"
                        b-value="{{ old('email') }}"
                        b-err="{{ $errors->has('email') }}"
                        b-error="{{ $errors->first('email') }}">
                    </now-input>

                    <!-- Password -->
                    <now-input class="form-group-no-border {{ $errors->has('password') ? ' has-danger' : '' }}" 
                        b-icon="ion-locked" 
                        b-placeholder="Password"
                        b-name="password"
                        b-type="password"
                        b-value="{{ old('password') }}"
                        b-err="{{ $errors->has('password') }}"
                        b-error="{{ $errors->first('password') }}">
                    </now-input>

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
        </template>
    </bootstrap-card>
</div>

@endsection
