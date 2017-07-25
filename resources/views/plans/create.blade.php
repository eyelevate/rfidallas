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
    <li class="breadcrumb-item"><a href="{{ route('plans_index') }}">Plans</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>

<div class="container-fluid">
	<form class="" method="POST" action="{{ route('plans_store') }}">

	{{ csrf_field() }}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Create A Plan </template>
			<template slot = "body">
	            <div class="content">
	            	<!--Name-->
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

	                <!--Desc-->
	                <bootstrap-textarea class="form-group-no-border {{ $errors->has('desc') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Description"
	                    b-placeholder="Detailed description of plan"
	                    b-name="desc"
	                    b-type="text"
	                    b-value="{{ old('desc') }}"
	                    b-err="{{ $errors->has('desc') }}"
	                    b-error="{{ $errors->first('desc') }}"
	                    >
	                </bootstrap-textarea>

	                <!-- Pre -->

	                <!-- Price -->

	                <!-- Post -->

	                <!-- Cancel -->

	                <!-- Hourly -->

	                <!-- Daily -->

	                <!-- Weekly -->

	                <!-- Monthly -->

	                <!-- Yearly -->

	                <!-- Start -->

	                <!-- End -->

	          
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
<bootstrap-modal id="preFeeModal" b-size="modal-lg">
	<template slot="header">Select Pre Fee(s)</template>
	<template slot="body">
		<div class="table-responsive">
			<bootstrap-table
				:columns="{{ $fee_columns }}"
				:rows="{{ $fee_rows }}"
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
<bootstrap-modal id="postFeeModal" b-size="modal-lg">
	<template slot="header">Select Post Fee(s)</template>
	<template slot="body">
		<div class="table-responsive">
			<bootstrap-table
				:columns="{{ $fee_columns }}"
				:rows="{{ $fee_rows }}"
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
<bootstrap-modal id="cancelFeeModal" b-size="modal-lg">
	<template slot="header">Select Cancel Fee(s)</template>
	<template slot="body">
		<div class="table-responsive">
			<bootstrap-table
				:columns="{{ $fee_columns }}"
				:rows="{{ $fee_rows }}"
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
<bootstrap-modal id="serviceModal" b-size="modal-lg">
	<template slot="header">Select Service</template>
	<template slot="body">
		<div class="table-responsive">
			<bootstrap-table
				:columns="{{ $service_columns }}"
				:rows="{{ $service_rows }}"
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