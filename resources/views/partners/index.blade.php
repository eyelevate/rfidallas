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
    <li class="breadcrumb-item active">Partners</li>
</ol>
<div class="container-fluid">

	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Partners Search Results</template>
		<template slot="body">
			<bootstrap-table
				title="Partners Search Results"
				:columns="{{ $columns }}"
				:rows="{{ $rows }}"
				:paginate="true"
				:global-search="true"
				:line-numbers="true"/>
			</bootstrap-table>

		</template>
		<template slot="footer">
			<a href="{{ route('partners_create') }}" class="btn btn-primary">Add Partner</a>
		</template>
	</bootstrap-card>
</div>
@endsection

@section('modals')
@if (count($rows) > 0)
	@foreach($rows as $row)
		<bootstrap-modal id="viewModal-{{ $row->id }}">
			<template slot="header">View Partner Details - {{ $row->name }}</template>
			<template slot="body">
				<!-- First Name -->
				<div class="form-group">
			        <label>First Name</label>
			        <div class="input-group" >
			            <input type="text" readonly="true" class="form-control" value="{{ $row->first_name }}" style="background-color:#ffffff;"/>
			            
			        </div>
				</div>

				<!-- Last Name -->
				<div class = "form-group">
			        <label>Last Name</label>
			        <div class="input-group" >
			            <textarea type="text" readonly="true" class="form-control" style="background-color:#ffffff;">{{ $row->last_name }}</textarea>
			            
			        </div>
				</div>

				<!-- Phone -->
				<div class = "form-group">
			        <label>Phone</label>
			        <div class="input-group" >
			            <textarea type="text" readonly="true" class="form-control" style="background-color:#ffffff;">{{ $row->phone }}</textarea>
			            
			        </div>
				</div>
				<!-- Email -->
				<div class = "form-group">
			        <label>Email</label>
			        <div class="input-group" >
			            <textarea type="text" readonly="true" class="form-control" style="background-color:#ffffff;">{{ $row->email }}</textarea>
			            
			        </div>
				</div>
				
			</template>
			<template slot="footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">Delete</button>	
				<a href="{{ route('partners_edit',$row->id) }}" class="btn btn-primary">Edit</a>
			</template>
		</bootstrap-modal>


		{!! Form::open(['method'=>'delete','route'=>['partners_destroy',$row->id]]) !!}
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