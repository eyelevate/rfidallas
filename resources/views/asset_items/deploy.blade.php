@extends('layouts.backend')

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/assets/deploy.js') }}"></script>
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('assets_index') }}">Assets</a></li>
    <li class="breadcrumb-item active">Deploy</li>
</ol>
<div class="container-fluid">
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">Deploy Form</template>
		<template slot="body">
			<!-- Company id -->
            <bootstrap-select class="form-group-no-border {{ $errors->has('company_id') ? ' has-danger' : '' }}"
                use-label = "true"
					label = "(Step 1) Select Company"
                b-err="{{ $errors->has('company_id') }}"
                b-error="{{ $errors->first('company_id') }}"
                >
                <template slot="select">
                	<div class="input-group">
                		<span class="input-group-btn">
							<button id="pre-select" class="btn btn-secondary" type="button" data-toggle="modal" data-target="#userModal">Find By User</button>
						</span>
						<input name="company_text" v-model="company_name" readonly="true" class="form-control" style="background-color:#ffffff;"/>
                		<span class="input-group-btn">
							<button id="pre-select" class="btn btn-secondary" type="button" data-toggle="modal" data-target="#companyModal">Find Company</button>
						</span>
                	</div>
                	<div id="company-id">
                		<input type="hidden" name="company_id" v-model="company_id"/>
                	</div>
                </template>
                
            </bootstrap-select>
            <hr/>
            <bootstrap-select class="form-group-no-border {{ $errors->has('serial') ? ' has-danger' : '' }}"
                use-label = "true"
					label = "(Step 2) Serial Number"
                b-err="{{ $errors->has('serial') }}"
                b-error="{{ $errors->first('serial') }}"
                >
                <template slot="select">
                	<div class="input-group">
						<input name="serial" class="form-control" @keyup.enter="serialSubmit" v-model="serial"/>
                		<span class="input-group-btn">
							<button class="btn btn-primary" type="button" @click="serialSubmit">Deploy</button>
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
	            			<td><span class="badge badge-success">deployed</span></td>
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
<bootstrap-modal id="userModal" b-size="modal-lg">
	<template slot="header">
		<ul class="nav nav-tabs card-header-tabs" role="tablist">
			<li class="nav-item">
				<a id="nav-select-users" href="#usersSelect" class="nav-link active" data-toggle="tab" role="tab">(1) Select </a>
			</li>
			<li class="nav-item">
				<a id="nav-select-company" href="#companiesSelect" class="nav-link" data-toggle="tab" role="tab">(2) Companies <span class="badge badge-info">@{{ companyCount }}</span></a>
			</li>
		</ul>
	</template>
	<template slot="body">
		<div class="tab-content" style="border:none;">
			<div class="tab-pane active" role="tabpanel" id="usersSelect">
				<div class="table-responsive">
					<bootstrap-table
						:columns="{{ $user_columns }}"
						:rows="{{ $user_rows }}"
						:paginate="true"
						:global-search="true"
						:line-numbers="true"/>
					</bootstrap-table>
			    </div>
			</div>
			<div class="tab-pane" role="tabpanel" id="companiesSelect">
				<div class="table-responsive">
					<table class="table table-sm table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Street</th>
								<th>Suite</th>
								<th>State</th>
								<th>Zipcode</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="c in company">
								<td>@{{ c.id }}</td>
								<td>@{{ c.name }}</td>
								<td>@{{ c.street }}</td>
								<td>@{{ c.suite }}</td>
								<td>@{{ c.state }}</td>
								<td>@{{ c.zipcode }}</td>
								<td>@{{ c.phone }}</td>
								<td>@{{ c.email }}</td>
								<td><button class="btn btn-sm btn-success" @click="selectCompanyFromUser(c.id)">Select</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</template>
	<template slot="footer">
		<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	
	</template>
</bootstrap-modal>
<bootstrap-modal id="companyModal" b-size="modal-lg">
	<template slot="header">Select Company</template>
	<template slot="body">
		<div class="table-responsive">
			<bootstrap-table
				:columns="{{ $company_columns }}"
				:rows="{{ $company_rows }}"
				:paginate="true"
				:global-search="true"
				:line-numbers="true"/>
			</bootstrap-table>
	    </div>
	</template>
	<template slot="footer">
		<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	
	</template>
</bootstrap-modal>
@endsection
@section('variables')
<div class="hide">
	{{ Form::hidden('users',json_encode($user_rows),['id'=>'get-users-data']) }}
	{{ Form::hidden('companies',json_encode($company_rows),['id'=>'get-companies-data']) }}
</div>
@endsection