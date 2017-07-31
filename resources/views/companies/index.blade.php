@extends('layouts.backend')

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
@endsection
@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item active">Companies</li>
</ol>
<div class="container-fluid">
	
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Companies Search Results</template>
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
			<a href="{{ route('companies_create') }}" class="btn btn-primary">Add Company</a>
		</template>
	</bootstrap-card>
	
</div>
@endsection

@section('modals')
@if (isset($rows))
	@foreach($rows as $row)
	<bootstrap-modal id="viewModal-{{ $row->id }}" b-size="modal-lg">
		<template slot="header">Company View</template>
		<template slot="body">
			<div class="table-responsive">
				<!-- Name -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->name }}"
					use-label="true"
					b-label="Name">	
				</bootstrap-readonly>

				<!-- Nick Name -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->nick_name }}"
					use-label="true"
					b-label="Nick Name"
				></bootstrap-readonly>

				<!-- Phone -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->phone }}"
					use-label="true"
					b-label="Phone"
				></bootstrap-readonly>

				<!-- Phone Option -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->phone_option }}"
					use-label="true"
					b-label="Phone (optional)"
				></bootstrap-readonly>

				<!-- Email -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->email }}"
					use-label="true"
					b-label="Email"
				></bootstrap-readonly>

				<!-- Street -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->street }}"
					use-label="true"
					b-label="Street"
				></bootstrap-readonly>

				<!-- Suite -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->suite }}"
					use-label="true"
					b-label="Suite"
				></bootstrap-readonly>

				<!-- City -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->city }}"
					use-label="true"
					b-label="City"
				></bootstrap-readonly>

				<!-- State -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->state }}"
					use-label="true"
					b-label="State"
				></bootstrap-readonly>

				<!-- Country -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->country }}"
					use-label="true"
					b-label="Country"
				></bootstrap-readonly>

				<!-- zipcode -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->zipcode }}"
					use-label="true"
					b-label="Zipcode"
				></bootstrap-readonly>

				<!-- User -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->users->email }} ({{ $row->users->first_name }} {{ $row->users->last_name }})"
					use-label="true"
					b-label="User"
				></bootstrap-readonly>

				@if (isset($row->plans))
				<!-- Plan -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->plans->name }}"
					use-label="true"
					b-label="Plan"
				></bootstrap-readonly>
				@else
				<!-- Plan -->
				<bootstrap-readonly
					use-input="true"
					b-value="No Plan Subscription Set"
					use-label="true"
					b-label="Plan"
				></bootstrap-readonly>
				@endif


				<!-- Payment Gateway -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->payment_gateway }}"
					use-label="true"
					b-label="Payment Gateway"
				></bootstrap-readonly>

				<!-- Payment API -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->payment_api_key }}"
					use-label="true"
					b-label="Payment API key"
				></bootstrap-readonly>

		    </div>
		</template>
		<template slot="footer">
			<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	
			<button id="deleteModal" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">Delete</button>	
			<a href="{{ route('companies_edit',$row->id) }}" class="btn btn-primary">Edit</a>
		</template>
	</bootstrap-modal>
	<bootstrap-modal id="ownerModal-{{ $row->users->id }}" b-size="modal-lg">
		<template slot="header">View Owner</template>
		<template slot="body">
			<div class="table-responsive">
				<!-- ID -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->users->id }}"
					use-label="true"
					b-label="ID">	
				</bootstrap-readonly>

				<!-- First Name -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->users->first_name }}"
					use-label="true"
					b-label="First Name">	
				</bootstrap-readonly>

				<!-- Last Name -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->users->last_name }}"
					use-label="true"
					b-label="Last Name">	
				</bootstrap-readonly>

				<!-- Phone -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->users->phone }}"
					use-label="true"
					b-label="Phone">	
				</bootstrap-readonly>
				<!-- Email -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->users->email }}"
					use-label="true"
					b-label="Email">	
				</bootstrap-readonly>
		    </div>
		</template>
		<template slot="footer">
			<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	
		</template>
	</bootstrap-modal>
	{!! Form::open(['method'=>'delete','route'=>['companies_destroy',$row->id]]) !!}
		<bootstrap-modal id="deleteModal-{{ $row->id }}">
			<template slot="header">Delete Confirmation</template>
			<template slot="body">
				Are you sure you wish to delete {{ $row->name}}?
			</template>
			<template slot="footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-danger">Delete</button>	
			</template>
		</bootstrap-modal>
		{!! Form::close() !!}
	@endforeach
@endif
@endsection