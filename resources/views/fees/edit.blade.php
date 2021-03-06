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
    <li class="breadcrumb-item"><a href="{{ route('fees_index') }}">Fees</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>

<div class="container-fluid">
	{!! Form::open(['method'=>'patch','route'=>['fees_update',$fee->id]]) !!}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Update Fee </template>
			<template slot = "body">
			

	            <div class="content">
	            	
	            	<!-- First Name -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Name"
	                    b-placeholder="Name"
	                    b-name="name"
	                    b-type="text"
	                    b-value="{{ old('name') ? old('name') : $fee->name }}"
	                    b-err="{{ $errors->has('name') }}"
	                    b-error="{{ $errors->first('name') }}"
	                    >
	                </bootstrap-input>

					<!-- Description -->
	                <bootstrap-textarea class="form-group-no-border {{ $errors->has('desc') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Fee Description"
	                    b-placeholder="detailed description of fee"
	                    b-name="desc"
	                    b-type="text"
	                    b-value="{{ old('desc') ? old('desc') : $fee->desc }}"
	                    b-err="{{ $errors->has('desc') }}"
	                    b-error="{{ $errors->first('desc') }}"
	                    >
	                </bootstrap-textarea>


					<!-- Subtotal -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('pretax') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Subtotal"
	                    b-placeholder="0.00"
	                    b-name="pretax"
	                    b-type="text"
	                    b-value="{{ old('pretax') ? old('pretax') : $fee->pretax }}"
	                    b-err="{{ $errors->has('pretax') }}"
	                    b-error="{{ $errors->first('pretax') }}"
	                    
	                    >
	                </bootstrap-input>
	          
		        </div>
			</template>

			<template slot = "footer">
				<a href="{{ route('services_index') }}" class="btn btn-secondary">Back</a>
				<button type="submit" class = "btn btn-primary">Save</button>
			</template>

			
		</bootstrap-card>
	{!! Form::close() !!}
</div>






@endsection

@section('modals')

@endsection