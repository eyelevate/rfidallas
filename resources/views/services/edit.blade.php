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
    <li class="breadcrumb-item"><a href="{{ route('services_index') }}">Services</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>

<div class="container-fluid">
	{!! Form::open(['method'=>'patch','route'=>['services_update',$service->id]]) !!}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Update Service </template>
			<template slot = "body">
			

	            <div class="content">
	            	
	            	<!-- First Name -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Name"
	                    b-placeholder="Name"
	                    b-name="name"
	                    b-type="text"
	                    b-value="{{ old('name') ? old('name') : $service->name }}"
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
	                    b-value="{{ old('desc') ? old('desc') : $service->desc }}"
	                    b-err="{{ $errors->has('desc') }}"
	                    b-error="{{ $errors->first('desc') }}"
	                    >
	                </bootstrap-textarea>


					<!-- Hourly -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('hourly') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Hourly Rate"
	                    b-placeholder="0.00"
	                    b-name="hourly"
	                    b-type="text"
	                    b-value="{{ old('hourly') ? old('hourly') : $service->hourly }}"
	                    b-err="{{ $errors->has('hourly') }}"
	                    b-error="{{ $errors->first('hourly') }}"
	                    >
	                </bootstrap-input>

	                <!-- Daily -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('daily') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Daily Rate"
	                    b-placeholder="0.00"
	                    b-name="daily"
	                    b-type="text"
	                    b-value="{{ old('daily') ? old('daily') : $service->daily }}"
	                    b-err="{{ $errors->has('daily') }}"
	                    b-error="{{ $errors->first('daily') }}"
	                    >
	                </bootstrap-input>

	                <!-- Weekly -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('weekly') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Weekly Rate"
	                    b-placeholder="0.00"
	                    b-name="weekly"
	                    b-type="text"
	                    b-value="{{ old('weekly') ? old('weekly') : $service->weekly }}"
	                    b-err="{{ $errors->has('weekly') }}"
	                    b-error="{{ $errors->first('weekly') }}"
	                    >
	                </bootstrap-input>

	                <!-- Monthly -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('monthly') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Monthly Rate"
	                    b-placeholder="0.00"
	                    b-name="monthly"
	                    b-type="text"
	                    b-value="{{ old('monthly') ? old('monthly') : $service->monthly }}"
	                    b-err="{{ $errors->has('monthly') }}"
	                    b-error="{{ $errors->first('monthly') }}"
	                    >
	                </bootstrap-input>

	                <!-- Yearly -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('yearly') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Yearly Rate"
	                    b-placeholder="0.00"
	                    b-name="yearly"
	                    b-type="text"
	                    b-value="{{ old('yearly') ? old('yearly') : $service->yearly }}"
	                    b-err="{{ $errors->has('yearly') }}"
	                    b-error="{{ $errors->first('yearly') }}"
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