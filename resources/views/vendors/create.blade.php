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
    <li class="breadcrumb-item"><a href="{{ route('vendors_index') }}">Vendors</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>

<div class="container-fluid">
	<form class="" method="POST" action="{{ route('vendors_store') }}">

	{{ csrf_field() }}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Create A Vendor </template>
			<template slot = "body">
			

	            <div class="content">
	            	
	            	<!-- First Name -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Name"
	                    b-placeholder="Vendor Name"
	                    b-name="name"
	                    b-type="text"
	                    b-value="{{ old('name') }}"
	                    b-err="{{ $errors->has('name') }}"
	                    b-error="{{ $errors->first('name') }}"
	                    >
	                </bootstrap-input>

					<!--Last Name -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('nick_name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Nick Name (optional)"
	                    b-placeholder="Nick name to describe vendor"
	                    b-name="nick_name"
	                    b-type="text"
	                    b-value="{{ old('nick_name') }}"
	                    b-err="{{ $errors->has('nick_name') }}"
	                    b-error="{{ $errors->first('nick_name') }}"
	                    >
	                </bootstrap-input>


					<!-- Phone -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('phone') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Phone"
	                    b-placeholder="Phone"
	                    b-name="phone"
	                    b-type="text"
	                    b-value="{{ old('phone') }}"
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
	                    b-value="{{ old('email') }}"
	                    b-err="{{ $errors->has('email') }}"
	                    b-error="{{ $errors->first('email') }}"
	                    >
	                </bootstrap-input>

	                <!-- Street -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('street') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Street"
	                    b-placeholder="Street Address"
	                    b-name="street"
	                    b-type="text"
	                    b-value="{{ old('street') }}"
	                    b-err="{{ $errors->has('street') }}"
	                    b-error="{{ $errors->first('street') }}"
	                    >
	                </bootstrap-input>

	                <!-- Suite -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('suite') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Suite (optional)"
	                    b-placeholder="Suite / Apt # / Building # / Etc.."
	                    b-name="suite"
	                    b-type="text"
	                    b-value="{{ old('suite') }}"
	                    b-err="{{ $errors->has('suite') }}"
	                    b-error="{{ $errors->first('suite') }}"
	                    >
	                </bootstrap-input>

	                <!-- City -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('city') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "City"
	                    b-placeholder="City"
	                    b-name="city"
	                    b-type="text"
	                    b-value="{{ old('city') }}"
	                    b-err="{{ $errors->has('city') }}"
	                    b-error="{{ $errors->first('city') }}"
	                    >
	                </bootstrap-input>

	                <!-- State -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('state') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "State"
	                    b-err="{{ $errors->has('state') }}"
	                    b-error="{{ $errors->first('state') }}"
	                    >
	                    <template slot="select">
	                    	{{ Form::select('state',$states,'',['class'=>'custom-select']) }}	
	                    </template>
	                    
	                </bootstrap-select>
	                <!-- Country-->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('country') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Country"
	                    b-err="{{ $errors->has('country') }}"
	                    b-error="{{ $errors->first('country') }}"
	                    >
	                    <template slot="select">
	                    	{{ Form::select('country',$countries,'US',['class'=>'custom-select']) }}	
	                    </template>
	                    
	                </bootstrap-select>

	                <!-- Zipcode -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('zipcode') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Zipcode"
	                    b-placeholder="zipcode"
	                    b-name="zipcode"
	                    b-type="text"
	                    b-value="{{ old('zipcode') }}"
	                    b-err="{{ $errors->has('zipcode') }}"
	                    b-error="{{ $errors->first('zipcode') }}"
	                    >
	                </bootstrap-input>

	                <!-- Contact Name -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('contact_name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Contact Name"
	                    b-placeholder="name of our contact"
	                    b-name="contact_name"
	                    b-type="text"
	                    b-value="{{ old('contact_name') }}"
	                    b-err="{{ $errors->has('contact_name') }}"
	                    b-error="{{ $errors->first('contact_name') }}"
	                    >
	                </bootstrap-input>

	                <!-- Contact Options -->
	                <bootstrap-textarea class="form-group-no-border {{ $errors->has('contact_options') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Notes on Vendor"
	                    b-placeholder="vendor notes here.."
	                    b-name="contact_option"
	                    b-type="text"
	                    b-value="{{ old('contact_options') }}"
	                    b-err="{{ $errors->has('contact_options') }}"
	                    b-error="{{ $errors->first('contact_options') }}"
	                    >
	                </bootstrap-textarea>
	          
		        </div>
			</template>

			<template slot = "footer">
				<a href="{{ route('vendors_index') }}" class="btn btn-secondary">Back</a>
				<button type="submit" class = "btn btn-primary">Save</button>
			</template>

			
		</bootstrap-card>
	</form>	
</div>






@endsection

@section('modals')

@endsection