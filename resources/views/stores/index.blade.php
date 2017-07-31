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
    <li class="breadcrumb-item active">Stores</li>
</ol>
<div class="container-fluid">
	
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Stores Search Results</template>
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
			<a href="{{ route('stores_create') }}" class="btn btn-primary">Add Store Location</a>
		</template>
	</bootstrap-card>
	
</div>
@endsection

@section('modals')
@if (count($rows) > 0)
	@foreach($rows as $row)
		<bootstrap-modal id="viewModal-{{ $row->id }}" b-size="modal-lg">
			<template slot="header">View Store - {{ $row->name }}</template>
			<template slot="body">
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
					b-label="suite"
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

				<!-- Store Hours -->
				<hr/>
				<label>Store Hours</label>
				<div class="table-responsive">
					<table class="table-sm table table-hover">
						<thead>
							<tr>
								<th>Day</th>
								<th>Status</th>
								<th>Open Hours</th>
								<th>Closed Hours</th>
							</tr>
						</thead>
						<tbody>
						@if(isset($row->hours))
							@foreach ($row->hours as $hkey => $hvalue)
							<tr>
								<td>{{ $days[$hkey] }}</td>
								<td>{{ $hvalue->status }}</td>
								<td>{{ $hvalue->open_hours }}:{{ $hvalue->open_minutes }}{{ $hvalue->open_ampm }}</td>
								<td>{{ $hvalue->closed_hours }}:{{ $hvalue->closed_minutes }}{{ $hvalue->closed_ampm }}</td>
							</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>

				
			</template>
			<template slot="footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">Delete</button>	
				<a href="{{ route('stores_edit',$row->id) }}" class="btn btn-primary">Edit</a>
			</template>
		</bootstrap-modal>
		{!! Form::open(['method'=>'delete','route'=>['stores_destroy',$row->id]]) !!}
		<bootstrap-modal id="deleteModal-{{ $row->id }}">
			<template slot="header">Delete Confirmation</template>
			<template slot="body">
				Are you sure you wish to delete {{ $row->full_name }}?
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