@extends('layouts.backend')

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/assets/return.js') }}"></script>
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('assets_index') }}">Assets</a></li>
    <li class="breadcrumb-item active">Deploy</li>
</ol>
<div class="container-fluid">
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Return Form</template>
		<template slot="body">
            <bootstrap-select class="form-group-no-border {{ $errors->has('serial') ? ' has-danger' : '' }}"
                use-label = "true"
					label = "Enter Serial Number"
                b-err="{{ $errors->has('serial') }}"
                b-error="{{ $errors->first('serial') }}"
                >
                <template slot="select">
                	<div class="input-group">
						<input name="serial" class="form-control" @keyup.enter="serialSubmit" v-model="serial" autofocus/>
                		<span class="input-group-btn">
							<button class="btn btn-primary" type="button" @click="serialSubmit">Return</button>
						</span>
                	</div>
                </template>
            	
            </bootstrap-select>
            <hr/>
            <div class="table-responsive">
	            <table class="table table-inverse table-sm table-hover table-striped">
	            	<thead>
	            		<tr>
	            			<th>ID</th>
	            			<th>Asset</th>
	            			<th>Model</th>
	            			<th>Serial</th>
	            			<th>Company</th>
	            			<th>Status</th>
	            			<th>Action</th>
	            		</tr>
	            	</thead>
	            	<tbody>
	            		<tr v-for="a in assets">
	            			<td>@{{ a.id }}</td>
	            			<td>@{{ a.name }}</td>
	            			<td>@{{ a.model }}</td>
	            			<td>@{{ a.serial }}</td>
	            			<td>@{{ a.company_name }}</td>
	            			<td><span class="badge badge-success">returned</span></td>
	            			<td><button class="btn btn-sm btn-danger" @click="undoAsset(a.id)">Undo</button></td>
	            		</tr>
	            	</tbody>
	            </table>
			</div>
		</template>
		<template slot="footer">
			<a href="{{ route('assets_index') }}" class="btn btn-secondary">Done</a>
		</template>
	</bootstrap-card>
</div>

@endsection

@section('modals')

@endsection
