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
    <li class="breadcrumb-item"><a href="{{ route('assets_index') }}">Assets</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>

<div class="container-fluid">
	{!! Form::open(['method'=>'post','route'=>['asset_items_store']]) !!}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Add Asset Item </template>
			<template slot = "body">
			

	            <div class="content">

	            	<!-- Asset ID -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('asset_id') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Asset Group"
	                    b-err="{{ $errors->has('asset_id') }}"
	                    b-error="{{ $errors->first('asset_id') }}"
	                    >
	                    <template slot="select">
	                    	{{ Form::select('asset_id',$assets,old('asset_id'),['class'=>'custom-select']) }}	
	                    </template>
                    </bootstrap-select>
	            	
	            	<!-- First Name -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Name"
	                    b-placeholder="Name"
	                    b-name="name"
	                    b-type="text"
	                    b-value="{{ old('name') }}"
	                    b-err="{{ $errors->has('name') }}"
	                    b-error="{{ $errors->first('name') }}"
	                    >
	                </bootstrap-input>

					<!-- Description -->
	                <bootstrap-textarea class="form-group-no-border {{ $errors->has('desc') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Description"
	                    b-placeholder="detailed description of item"
	                    b-name="desc"
	                    b-type="text"
	                    b-value="{{ old('desc')}}"
	                    b-err="{{ $errors->has('desc') }}"
	                    b-error="{{ $errors->first('desc') }}"
	                    >
	                </bootstrap-textarea>

	                <!-- Model -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('model') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Model"
	                    b-placeholder="model number"
	                    b-name="model"
	                    b-type="text"
	                    b-value="{{ old('model') }}"
	                    b-err="{{ $errors->has('model') }}"
	                    b-error="{{ $errors->first('model') }}"
	                    
	                    >
	                </bootstrap-input>

	                <!-- Serial -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('serial') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Serial"
	                    b-placeholder="serial number"
	                    b-name="serial"
	                    b-type="text"
	                    b-value="{{ old('serial') }}"
	                    b-err="{{ $errors->has('serial') }}"
	                    b-error="{{ $errors->first('serial') }}"
	                    
	                    >
	                </bootstrap-input>



					<!-- Price -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('price') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Purchase Price (after tax)"
	                    b-placeholder="0.00"
	                    b-name="price"
	                    b-type="text"
	                    b-value="{{ old('price') }}"
	                    b-err="{{ $errors->has('price') }}"
	                    b-error="{{ $errors->first('price') }}"
	                    
	                    >
	                </bootstrap-input>

	                <!-- Vendor -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('vendor_id') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Purchased From This Vendor"
	                    b-err="{{ $errors->has('vendor_id') }}"
	                    b-error="{{ $errors->first('vendor_id') }}"
	                    >
	                    <template slot="select">
	                    	{{ Form::select('vendor_id',$vendors,old('vendor_id') ,['class'=>'custom-select']) }}	
	                    </template>
                    </bootstrap-select>

 {{--                    <!-- Company -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('company_id') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Product deployed to Company"
	                    b-err="{{ $errors->has('company_id') }}"
	                    b-error="{{ $errors->first('company_id') }}"
	                    >
	                    <template slot="select">
	                    	{{ Form::select('company_id',$companies,old('company_id') ,['class'=>'custom-select']) }}	
	                    </template>
                    </bootstrap-select>

                    <!-- Status -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('status') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Status"
	                    b-err="{{ $errors->has('status') }}"
	                    b-error="{{ $errors->first('status') }}"
	                    >
	                    <template slot="select">
	                    	{{ Form::select('status',$statuses,old('status') ,['class'=>'custom-select']) }}	
	                    </template>
                    </bootstrap-select>

                    <!-- Reason -->
	                <bootstrap-textarea class="form-group-no-border {{ $errors->has('reason') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Notes (optional)"
	                    b-placeholder="any important notes to keep about asset"
	                    b-name="reason"
	                    b-type="text"
	                    b-value="{{ old('reason') }}"
	                    b-err="{{ $errors->has('reason') }}"
	                    b-error="{{ $errors->first('reason') }}"
	                    >
	                </bootstrap-textarea> --}}
	          
		        </div>
			</template>

			<template slot = "footer">
				<a href="{{ route('assets_index') }}" class="btn btn-secondary">Back</a>
				<button type="submit" class = "btn btn-primary">Save</button>
			</template>

			
		</bootstrap-card>
	{!! Form::close() !!}
</div>

@endsection

@section('modals')

@endsection