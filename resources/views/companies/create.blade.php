@extends('layouts.backend')


@section('styles')

@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
<script type="text/javascript" src="{{ mix('/js/views/companies/create.js') }}"></script>
@endsection

@section('content')
<!-- Breadcrumb -->	
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('companies_index') }}">Companies</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>

<div class="container-fluid">
	<form class="" method="POST" action="{{ route('companies_store') }}">

	{{ csrf_field() }}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Create A Company </template>
			<template slot = "body">
	            <div class="content">

	            	<!-- User -->

	                <bootstrap-select class="form-group-no-border {{ $errors->has('user_id') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "User"
	                    b-err="{{ $errors->has('user_id') }}"
	                    b-error="{{ $errors->first('user_id') }}"
	                    >
	                    <template slot="select">
	                    	<div class="input-group">
	                    		{{ Form::text('user_display',old('user_id'),['id'=>'user-display','class'=>'form-control','readonly'=>'true','style'=>'background-color:#ffffff;']) }}
	                    		<span class="input-group-btn">
									<button id="searchUsers" class="btn btn-secondary" type="button" data-toggle="modal" data-target="#userModal">Select User</button>
								</span>
	                    	</div>
	                    	{{ Form::hidden('user_id','',['id'=>'user-id-hidden-input']) }}
	                    </template>
	                    
	                </bootstrap-select>
	            	
	            	<!--Name-->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Name"
	                    b-placeholder="Company Name"
	                    b-name="name"
	                    b-type="text"
	                    b-value="{{ old('name') }}"
	                    b-err="{{ $errors->has('name') }}"
	                    b-error="{{ $errors->first('name') }}"
	                    >
	                </bootstrap-input>

					<!--Nick Name -->
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

	                <!-- Phone -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('phone_option') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Second Phone (optional)"
	                    b-placeholder="fax\mobile etc.."
	                    b-name="phone_option"
	                    b-type="text"
	                    b-value="{{ old('phone_option') }}"
	                    b-err="{{ $errors->has('phone_option') }}"
	                    b-error="{{ $errors->first('phone_option') }}"
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
	          
		        </div>
			</template>

			<template slot = "footer">
				<a href="{{ route('companies_index') }}" class="btn btn-secondary">Back</a>
				<button type="submit" class = "btn btn-primary">Save</button>
			</template>

			
		</bootstrap-card>
	</form>	
</div>

@endsection

@section('modals')
<bootstrap-modal id="userModal" b-size="modal-lg">
	<template slot="header">Select User</template>
	<template slot="body">
		<div class="table-responsive">
			<bootstrap-table
				:columns="{{ $columns }}"
				:rows="{{ $rows }}"
				:paginate="true"
				:global-search="true"
				:line-numbers="true"/>
			</bootstrap-table>
	    </div>
	</template>
	<template slot="footer">
		<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	
	</template>
</bootstrap-modal>
@endsection