@extends('layouts.backend')


@section('styles')

@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>

@endsection

@section('content')
<!-- Breadcrumb -->	
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('customers_index') }}">Customer</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>


<form class="" method="POST" action="{{ route('customers_update') }}">

	{{ csrf_field() }}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Create Customer </template>
			<template slot = "body">
			

	            <div class="content">
	            	
	            	<!-- First Name -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('first_name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "First Name"
	                    b-placeholder="First Name"
	                    b-name="first_name"
	                    b-type="text"
	                    b-value="{{ (old('first_name')) ? old('first_name') : $customer->first_name }}"
	                    b-err="{{ $errors->has('first_name') }}"
	                    b-error="{{ $errors->first('first_name') }}"
	                 
	                    >
	                </bootstrap-input>

					<!--Last Name -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('last_name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Last Name"
	                    b-placeholder="Last Name"
	                    b-name="last_name"
	                    b-type="text"
	                    b-value="{{ (old('last_name')) ? old('last_name') : $customer->last_name }}"
	                    b-err="{{ $errors->has('last_name') }}"
	                    b-error="{{ $errors->first('last_name') }}"
	                  
	                    >
	                </bootstrap-input>


					<!-- Phone -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('phone') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Phone"
	                    b-placeholder="Phone"
	                    b-name="phone"
	                    b-type="text"
	                    b-value="{{ (old('phone')) ? old('phone') : $customer->phone }}"
	                    b-err="{{ $errors->has('phone') }}"
	                    b-error="{{ $errors->first('phone') }}"
	                    
	                    >
	                </bootstrap-input>


					<!-- E-mail -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('email') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "E-mail Address"
	                    b-placeholder="E-mail Address"
	                    b-name="email"
	                    b-type="email"
	                    b-value="{{ (old('email')) ? old('email') : $customer->email }}"
	                    b-err="{{ $errors->has('email') }}"
	                    b-error="{{ $errors->first('email') }}"
	                    >
	                </bootstrap-input>


	                <!-- Password -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('password') ? ' has-danger' : '' }}" 
	 					use-label = "true"
	 					label = "Password"
	                    b-placeholder="Password"
	                    b-name="password"
	                    b-type="password"
	                    b-value="{{ old('password') }}"
	                    b-err="{{ $errors->has('password') }}"
	                    b-error="{{ $errors->first('password') }}">
	                </bootstrap-input>


	                <!-- Confirm Password -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Confirm Password"
	                    b-placeholder="Confirm Password"
	                    b-name="password_confirmation"
	                    b-type="password"
                        b-value="{{ old('password_confirmation') }}"
                        b-err="{{ $errors->has('password_confimration') }}"
                        b-error="{{ $errors->first('password_confirmation') }}">
	                </bootstrap-input>
              

              
		        </div>
			</template>

			<template slot = "footer">
				<a href="{{ route('customers_index') }}" class="btn btn-secondary">Back</a>
				<button type="submit" class = "btn btn-primary">Save</button>
			</template>

			
		</bootstrap-card>
	</form>





@endsection

@section('modals')

@endsection