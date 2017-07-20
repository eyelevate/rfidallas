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
    <li class="breadcrumb-item active">Customer</li>
</ol>
<div class="container-fluid" style="padding-top:25px;">
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Customer Search Results</template>
		<template slot="body">
			<div class="row">
				<bootstrap-table
					title="Customer Search Results"
					:columns="{{ $columns }}"
					:rows="{{ $rows }}"
					:paginate="true"
					:global-search="true"
					:line-numbers="true"/>
				</bootstrap-table>
		    </div>
		</template>
		<template slot="footer">
			<a href="{{ route('customers_create') }}" class="btn btn-primary">Add Customer</a>
		</template>
	</bootstrap-card>
</div>
@endsection

@section('modals')
@if (count($rows) > 0)
	@foreach($rows as $row)
		{!! Form::open(['method'=>'delete','route'=>['customers_destroy',$row->id]]) !!}
		<bootstrap-modal id="deleteModal-{{ $row->id }}">
			<template slot="header">Delete Confirmation</template>
			<template slot="body">
				Are you sure you wish to delete {{ $row->email }}?
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