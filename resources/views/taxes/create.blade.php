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
    <li class="breadcrumb-item"><a href="{{ route('taxes_index') }}">Taxes</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>

<div class="container-fluid">
	<form class="" method="POST" action="{{ route('taxes_store') }}">

		{{ csrf_field() }}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Update Tax Rate </template>
			<template slot = "body">
			

	            <div class="content">
	            	
	            	<!-- Rate -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('rate') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Rate"
	                    b-placeholder="1 = 100% / 0.10 = 10% etc..."
	                    b-name="rate"
	                    b-type="text"
	                    b-value="{{ old('rate') }}"
	                    b-err="{{ $errors->has('rate') }}"
	                    b-error="{{ $errors->first('rate') }}"
	                 
	                    >
	                </bootstrap-input>

              
		        </div>
			</template>

			<template slot = "footer">
				<a href="{{ route('taxes_index') }}" class="btn btn-secondary">Back</a>
				<button type="submit" class = "btn btn-primary">Save</button>
			</template>

			
		</bootstrap-card>
	</form>
</div>




@endsection

@section('modals')

@endsection