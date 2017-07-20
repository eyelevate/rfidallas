@extends('layouts.backend_login')

@section('styles')

@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/login.js') }}"></script>
@endsection

@section('header')
<br/><br/><br/>
@endsection

@section('content')

<div class="row" style="padding-top:30px;">
    <bootstrap-card class="card-backend" use-body="true" use-header="true">
        <template slot="header">Login</template>
        <template slot="body">
            <form class="form-horizontal" method="POST" action="{{ route('admins_auth') }}">
                {{ csrf_field() }}

                <div class="content">
                <!-- Email -->
                    <bootstrap-input class="form-group-no-border {{ $errors->has('email') ? ' has-danger' : '' }}" 
                        b-icon="ion-email" 
                        use-icon= "true"
                        b-placeholder="Email Address"
                        b-name="email"
                        b-type="email"
                        b-value="{{ old('email') }}"
                        b-err="{{ $errors->has('email') }}"
                        b-error="{{ $errors->first('email') }}">
                    </bootstrap-input>

                    <!-- Password -->
                    <bootstrap-input class="form-group-no-border {{ $errors->has('password') ? ' has-danger' : '' }}" 
                        b-icon="ion-locked" 
                        use-icon= "true"
                        b-placeholder="Password"
                        b-name="password"
                        b-type="password"
                        b-value="{{ old('password') }}"
                        b-err="{{ $errors->has('password') }}"
                        b-error="{{ $errors->first('password') }}">
                    </bootstrap-input>

                    <div class="col-12">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                    
                </div>
                <div class="footer text-center">
                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                    </button>
                </div>
            </form>
        </template>
    </bootstrap-card>
</div>
<br/><br/>

@endsection