@extends('layouts.frontend')
@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/auth/register.js') }}"></script>
@endsection
@section('header')
<br/><br/>
@endsection
@section('content')

    <div class="row">
        <bootstrap-card class="card-signup" data-background-color="orange" use-body="true">
            <template slot="header"></template>
            <template slot="body">
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="header header-primary text-center">
                        <h4 class="title title-up">Register</h4>
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
                        <!-- First Name -->
                        <now-input class="form-group-no-border {{ $errors->has('first_name') ? ' has-danger' : '' }}" 
                            b-icon="ion-ios-person-outline" 
                            b-placeholder="First Name"
                            b-name="first_name"
                            b-type="text"
                            b-value="{{ old('first_name') }}"
                            b-err="{{ $errors->has('first_name') }}"
                            b-error="{{ $errors->first('first_name') }}">
                        </now-input>
                        <!-- Last Name -->
                        <now-input class="form-group-no-border {{ $errors->has('last_name') ? ' has-danger' : '' }}" 
                            b-icon="ion-ios-person" 
                            b-placeholder="Last Name"
                            b-name="last_name"
                            b-type="text"
                            b-value="{{ old('last_name') }}"
                            b-err="{{ $errors->has('last_name') }}"
                            b-error="{{ $errors->first('last_name') }}">
                        </now-input>
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
                        <!-- Phone -->
                        <now-input class="form-group-no-border {{ $errors->has('phone') ? ' has-danger' : '' }}" 
                            b-icon="ion-android-call" 
                            b-placeholder="Phone"
                            b-name="phone"
                            b-type="text"
                            b-value="{{ old('phone') }}"
                            b-err="{{ $errors->has('phone') }}"
                            b-error="{{ $errors->first('phone') }}">
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

                        <!-- Confirm Password -->
                        <now-input class="form-group-no-border {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}" 
                            b-icon="ion-unlocked" 
                            b-placeholder="Confirm Password"
                            b-name="password_confirmation"
                            b-type="password"
                            b-value="{{ old('password_confirmation') }}"
                            b-err="{{ $errors->has('password_confimration') }}"
                            b-error="{{ $errors->first('password_confirmation') }}">
                        </now-input>            
                    </div>
                    <div class="footer text-center">
                        <button type="submit" class="btn btn-neutral btn-round btn-lg">
                            Register
                        </button>
                    </div>
                </form>
            </template>
        </bootstrap-card>
    </div>
@endsection
