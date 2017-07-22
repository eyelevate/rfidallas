@extends('layouts.backend')

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
@endsection
@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item active">Fees</li>
</ol>
<div class="container-fluid">
	
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Fees</template>
		<template slot="body">
			<div class="table-responsive">
				<bootstrap-table
					title="Fees Results"
					:columns="{{ $columns }}"
					:rows="{{ $rows }}"
					:paginate="true"
					:global-search="true"
					:line-numbers="true"/>
				</bootstrap-table>
		    </div>
		</template>
		<template slot="footer">
			<a href="{{ route('fees_create') }}" class="btn btn-primary">Add Fee</a>
		</template>
	</bootstrap-card>
	
</div>
@endsection

@section('modals')
@if (count($rows) > 0)
	@foreach($rows as $row)
		<bootstrap-modal id="viewModal-{{ $row->id }}">
			<template slot="header">View Fee - {{ $row->name }}</template>
			<template slot="body">
				<!-- Name -->
				<div class="form-group">
			        <label>Name</label>
			        <div class="input-group" >
			            <input type="text" readonly="true" class="form-control" value="{{ $row->name }}" style="background-color:#ffffff;"/>
			            
			        </div>
				</div>

				<!-- Description -->
				<div class = "form-group">
			        <label>Description</label>
			        <div class="input-group" >
			            <textarea type="text" readonly="true" class="form-control" style="background-color:#ffffff;">{{ $row->desc }}</textarea>
			            
			        </div>
				</div>

				<!-- Subtotal -->
				<div class = "form-group">
			        <label>Subtotal</label>
			        <div class="input-group" >
			            <textarea type="text" readonly="true" class="form-control" style="background-color:#ffffff;">{{ $row->pretax }}</textarea>
			            
			        </div>
				</div>
				
			</template>
			<template slot="footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">Delete</button>	
				<a href="{{ route('fees_edit',$row->id) }}" class="btn btn-primary">Edit</a>
			</template>
		</bootstrap-modal>
		{!! Form::open(['method'=>'delete','route'=>['fees_destroy',$row->id]]) !!}
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