@extends('layouts.backend')

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
@endsection

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('managers_index') }}">Managers</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
<div class="container-fluid">
{!! Form::open(['method'=>'patch','route'=>['managers_update',$manager->id]]) !!}
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Edit Form</template>
		<template slot="body">
			<bootstrap-input class="form-group-no-border {{ $errors->has('first_name') ? ' has-danger' : '' }}" 
{{-- 		        use-label="true",
		        label="First name" --}}
		        b-placeholder="First Name"
		        b-name="first_name"
		        b-type="text"
		        b-value="{{ old('first_name') ? old('first_name') : $manager->first_name }}"
		        b-err="{{ $errors->has('first_name') }}"
		        b-error="{{ $errors->first('first_name') }}">
		    </bootstrap-input>
		    <bootstrap-input class="form-group-no-border {{ $errors->has('last_name') ? ' has-danger' : '' }}" 
{{-- 		        use-label="true",
		        label="Last name" --}}
		        b-placeholder="Last Name"
		        b-name="last_name"
		        b-type="text"
		        b-value="{{ old('last_name') ? old('last_name') : $manager->last_name }}"
		        b-err="{{ $errors->has('last_name') }}"
		        b-error="{{ $errors->first('last_name') }}">
		    </bootstrap-input>
		    <bootstrap-input class="form-group-no-border {{ $errors->has('email') ? ' has-danger' : '' }}" 
{{-- 		        use-label="true",
		        label="Email Address" --}}
		        b-placeholder="Email Address"
		        b-name="email"
		        b-type="email"
		        b-value="{{ old('email') ? old('email') : $manager->email }}"
		        b-err="{{ $errors->has('email') }}"
		        b-error="{{ $errors->first('email') }}">
		    </bootstrap-input>
		    <bootstrap-input class="form-group-no-border {{ $errors->has('phone') ? ' has-danger' : '' }}" 
{{-- 		        use-label="true",
		        label="Phone" --}}
		        b-placeholder="Phone Number"
		        b-name="phone"
		        b-type="text"
		        b-value="{{ old('phone') ? old('phone') : $manager->phone }}"
		        b-err="{{ $errors->has('phone') }}"
		        b-error="{{ $errors->first('phone') }}">
		    </bootstrap-input>

		    <!-- Password -->
            <bootstrap-input class="form-group-no-border {{ $errors->has('password') ? ' has-danger' : '' }}" 
{{-- 		        use-label="true",
		        label="Phone" --}}
                b-placeholder="Password"
                b-name="password"
                b-type="password"
                b-value="{{ old('password') ? old('password') : '' }}"
                b-err="{{ $errors->has('password') }}"
                b-error="{{ $errors->first('password') }}">
            </bootstrap-input>
            <bootstrap-input class="form-group-no-border {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}" 
{{-- 		        use-label="true",
		        label="Confirm Password" --}}
                b-placeholder="Re-enter Password"
                b-name="password_confirmation"
                b-type="password"
                b-value="{{ old('password_confirmation') ? old('password_confirmation') : '' }}"
                b-err="{{ $errors->has('password_confirmation') }}"
                b-error="{{ $errors->first('password_confirmation') }}">
            </bootstrap-input>
		</template>
		<template slot="footer">
			<a class="btn btn-secondary">Back</a>
			<button class="btn btn-primary" type="submit">Update</button>
		</template>
	</bootstrap-card>
	
{!! Form::close() !!}
</div>
@endsection

@section('modals')
@endsection