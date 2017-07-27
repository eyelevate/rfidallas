@extends('layouts.backend')

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
@endsection
@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item active">Plans</li>
</ol>
<div class="container-fluid">
	
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Plans</template>
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
			<a href="{{ route('plans_create') }}" class="btn btn-primary">Add Plan</a>
		</template>
	</bootstrap-card>
	
</div>
@endsection

@section('modals')
@if (count($rows) > 0)
	@foreach($rows as $row)
		<bootstrap-modal id="viewModal-{{ $row->id }}" b-size="modal-lg">
			<template slot="header">View Plan - {{ $row->name }}</template>
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

				<!-- Pre -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->pre }}"
					use-label="true"
					b-label="Pre Fee"
				></bootstrap-readonly>

				<!-- Price -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->price }}"
					use-label="true"
					b-label="Sub Rate"
				></bootstrap-readonly>

				<!-- Post -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->post }}"
					use-label="true"
					b-label="Post Fee"
				></bootstrap-readonly>

				<!-- Cancel -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->cancel }}"
					use-label="true"
					b-label="Cancel Fee"
				></bootstrap-readonly>

				<fieldset class="form-group">
					<label>Allow Subscription Hourly?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->hourly,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>

				<fieldset class="form-group">
					<label>Allow Subscription Daily?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->daily,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>

				<fieldset class="form-group">
					<label>Allow Subscription Weekly?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->weekly,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>

				<fieldset class="form-group">
					<label>Allow Subscription Monthly?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->monthly,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>

				<fieldset class="form-group">
					<label>Allow Subscription Yearly?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->yearly,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>

				<!-- Hourly -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->start }}"
					use-label="true"
					b-label="Start Date"
				></bootstrap-readonly>

				<!-- Daily -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->end }}"
					use-label="true"
					b-label="End Date"
				></bootstrap-readonly>
			</template>
			<template slot="footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">Delete</button>	
				<a href="{{ route('plans_edit',$row->id) }}" class="btn btn-primary">Edit</a>
			</template>
		</bootstrap-modal>
		{!! Form::open(['method'=>'delete','route'=>['plans_destroy',$row->id]]) !!}
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