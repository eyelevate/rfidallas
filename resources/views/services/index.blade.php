@extends('layouts.backend')

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
@endsection
@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item active">Service</li>
</ol>
<div class="container-fluid">
	
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Service</template>
		<template slot="body">
			<div class="table-responsive">
				<bootstrap-table
					title="Service Results"
					:columns="{{ $columns }}"
					:rows="{{ $rows }}"
					:paginate="true"
					:global-search="true"
					:line-numbers="true"/>
				</bootstrap-table>
		    </div>
		</template>
		<template slot="footer">
			<a href="{{ route('services_create') }}" class="btn btn-primary">Add Service</a>
		</template>
	</bootstrap-card>
	
</div>
@endsection

@section('modals')
@if (count($rows) > 0)
	@foreach($rows as $row)
		<bootstrap-modal id="viewModal-{{ $row->id }}">
			<template slot="header">View Service - {{ $row->name }}</template>
			<template slot="body">
				<!-- Name -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->name }}"
					use-label="true"
					b-label="Name">	
				</bootstrap-readonly>

				<!-- Description -->
				<bootstrap-readonly
					use-textarea="true"
					b-value="{{ $row->desc }}"
					use-label="true"
					b-label="Description"
				></bootstrap-readonly>

				<!-- Hourly -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->hourly }}"
					use-label="true"
					b-label="Hourly"
				></bootstrap-readonly>

				<!-- Daily -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->daily }}"
					use-label="true"
					b-label="Daily"
				></bootstrap-readonly>

				<!-- Weekly -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->weekly }}"
					use-label="true"
					b-label="Weekly"
				></bootstrap-readonly>

				<!-- Monthly -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->monthly }}"
					use-label="true"
					b-label="Monthly"
				></bootstrap-readonly>

				<!-- Yearly -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->yearly }}"
					use-label="true"
					b-label="Yearly"
				></bootstrap-readonly>
			</template>
			<template slot="footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">Delete</button>	
				<a href="{{ route('services_edit',$row->id) }}" class="btn btn-primary">Edit</a>
			</template>
		</bootstrap-modal>
		{!! Form::open(['method'=>'delete','route'=>['services_destroy',$row->id]]) !!}
		<bootstrap-modal id="deleteModal-{{ $row->id }}">
			<template slot="header">Delete Confirmation</template>
			<template slot="body">
				Are you sure you wish to delete {{ $row->name }}?
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