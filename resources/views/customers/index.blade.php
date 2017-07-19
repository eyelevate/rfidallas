@extends('layouts.backend')


@section('styles')

@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>

@endsection

@section('content')
<div class="container-fluid" style="padding-top:25px;">
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Search Results</template>
		<template slot="body">
			<div class="row">
				<bootstrap-table
					title="Customer Search Results"
					:columns="{{ $columns }}"
					:rows="{{ $customers }}"
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

@endsection