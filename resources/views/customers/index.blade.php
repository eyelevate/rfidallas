@extends('layouts.backend')


@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css"> --}}
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
<script type="text/javascript">
	$('#example').DataTable();

</script>
@endsection

@section('content')
<div class="container-fluid" style="padding-top:25px;">
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Search Results</template>
		<template slot="body">
			<div class="row">
				<bootstrap-table
					title="Demo Table"
					:columns="columns"
					:rows="rows"
					:paginate="true"
					:lineNumbers="true"/>
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