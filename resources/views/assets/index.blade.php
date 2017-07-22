@extends('layouts.backend')

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
@endsection
@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item active">Assets</li>
</ol>
<div class="container-fluid">
	
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">
			<ul class="nav nav-tabs card-header-pills">
				@if(count($assets) > 0)

					@foreach($assets as $key => $asset)
					<li class="nav-item">
						<a data-toggle="tab" href="#tab-{{ $key }}" role="tab" class="nav-link {{ ($key == 0) ? 'active' : ''}}">{{ $asset->name }} <span class="badge badge-default">{{ count($asset->assetItems) }}</span></a>
					</li>
					@endforeach
				@endif
			</ul>
		</template>
		<template slot="body">
			<div class="tab-content">
			@if (count($assets) > 0)
				@foreach($assets as $key => $asset)
				<div class="tab-pane {{ ($key == 0) ? 'active' : ''}}" id="tab-{{ $key }}" role="tabpanel">
					<div class="table-responsive">
						<bootstrap-table
							:columns="{{ $columns }}"
							:rows="{{ $asset->assetItems }}"
							:paginate="true"
							:global-search="true"
							:line-numbers="true"/>
						</bootstrap-table>
					</div>
				</div>
				@endforeach
			@endif
			</div>
		</template>
		<template slot="footer">
			<a href="{{ route('assets_create') }}" class="btn btn-info">Add Group</a>
			<a href="{{ route('asset_items_create') }}" class="btn btn-primary">Add Asset</a>
			<a href="{{ route('asset_items_deploy') }}" class="btn btn-success">Deploy Asset(s)</a>
			<a href="{{ route('asset_items_return') }}" class="btn btn-warning">Return Asset(s)</a>

		</template>
	</bootstrap-card>
	
</div>
@endsection

@section('modals')

@if (count($assets) > 0)
	@foreach($assets as $asset)
		@if (count($asset->assetItems))
			@foreach($asset->assetItems as $ai)
			<bootstrap-modal id="viewModal-{{ $ai->id }}">
				<template slot="header">
					<ul class="nav nav-tabs card-header-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#overview-{{ $ai->id }}" role="tab">Overview</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#history-{{ $ai->id }}" role="tab">History</a>
						</li>
					</ul>
				</template>
				<template slot="body">
					<div class="tab-content" style="border:none;">
						<div class="tab-pane active" id="overview-{{ $ai->id }}" role="tabpanel">
							<!-- Name -->
							<bootstrap-readonly
								use-input="true"
								b-value="{{ $ai->name }}"
								use-label="true"
								b-label="Name"
							></bootstrap-readonly>
							<!-- Description -->
							<bootstrap-readonly
								use-textarea="true"
								b-value="{{ $ai->desc }}"
								use-label="true"
								b-label="Description"
							></bootstrap-readonly>
							<!-- Model -->
							<bootstrap-readonly
								use-input="true"
								b-value="{{ $ai->model }}"
								use-label="true"
								b-label="Model"
							></bootstrap-readonly>
							<!-- Serial -->
							<bootstrap-readonly
								use-input="true"
								b-value="{{ $ai->serial }}"
								use-label="true"
								b-label="Serial"
							></bootstrap-readonly>
							<!-- Price -->
							<bootstrap-readonly
								use-input="true"
								b-value="{{ $ai->price }}"
								use-label="true"
								b-label="price"
							></bootstrap-readonly>
							
			                <!-- Vendor -->
			                <bootstrap-select class="form-group-no-border {{ $errors->has('vendor_id') ? ' has-danger' : '' }}"
			                    use-label = "true"
			 					label = "Purchased From This Vendor"
			                    b-err="{{ $errors->has('vendor_id') }}"
			                    b-error="{{ $errors->first('vendor_id') }}"
			                    >
			                    <template slot="select">
			                    	{{ Form::select('vendor_id',$vendors,old('vendor_id') ? old('vendor_id') : $ai->vendor_id,['class'=>'custom-select','disabled'=>'true' ,'style'=>'background-color:#ffffff;']) }}	
			                    </template>
		                    </bootstrap-select>

		                    <!-- Company -->
			                <bootstrap-select class="form-group-no-border {{ $errors->has('company_id') ? ' has-danger' : '' }}"
			                    use-label = "true"
			 					label = "Product deployed to Company"
			                    b-err="{{ $errors->has('company_id') }}"
			                    b-error="{{ $errors->first('company_id') }}"
			                    >
			                    <template slot="select">
			                    	{{ Form::select('company_id',$companies,old('company_id') ? old('company_id') : $ai->company_id,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}	
			                    </template>
		                    </bootstrap-select>

		                    <!-- Status -->
			                <bootstrap-select class="form-group-no-border {{ $errors->has('status') ? ' has-danger' : '' }}"
			                    use-label = "true"
			 					label = "Status"
			                    b-err="{{ $errors->has('status') }}"
			                    b-error="{{ $errors->first('status') }}"
			                    >
			                    <template slot="select">
			                    	{{ Form::select('status',$statuses,old('status') ? old('status') : $ai->status,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}	
			                    </template>
		                    </bootstrap-select>
		                    <!-- Name -->
							<bootstrap-readonly
								use-textarea="true"
								b-value="{{ $ai->reason }}"
								use-label="true"
								b-label="Status Notes"
							></bootstrap-readonly>						
						</div>
						<div id="history-{{ $ai->id }}" class="tab-pane">
							<div class="list-group">
								@if (count($ai->assetItemHistory))
									@foreach($ai->assetItemHistory as $aih)

									<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
										<div class="d-flex w-100 justify-content-between">
											<h3 class="mb-1"><span class="badge {{ $aih->type_set['status'] }}">{{ $aih->type_set['text'] }}</span></h3>
											<small>{{ $aih->created_at->diffForHumans() }}</small>
										</div>
										@if ($aih->type > 7)
											@if (json_decode($aih->detail) !== NULL)
												<ul>
												@foreach(json_decode($aih->detail) as $detail)
												<li class="mb-1"><p>{{ $detail->name }}</p>
												<table class="table table-bordered table-striped table-sm table-hover">
													<thead>
														<tr>
															<th>Original</th>
															<th>New</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>{{ $detail->old }}</td>
															<td>{{ $detail->new }}</td>
														</tr>
													</tbody>
												</table>
												@endforeach
												</ul>
											@endif
										<ul>

										</ul>
										<small>Edited by: <strong>{{ $aih->user->email }}</strong> : {{ $aih->user->first_name }} {{ $aih->user->last_name }}</small>
										@else
										<p class="mb-1">{{ $aih->detail }}</p>
										<small>Created by: <strong>{{ $aih->user->email }}</strong> : {{ $aih->user->first_name }} {{ $aih->user->last_name }}</small>
										@endif
										
										
									</a>
									@endforeach
								@endif
							</div>
						</div>
				</template>
				<template slot="footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $ai->id }}">Delete</button>	
					<a href="{{ route('asset_items_edit',$ai->id) }}" class="btn btn-primary">Edit</a>
				</template>
			</bootstrap-modal>

			{!! Form::open(['method'=>'delete','route'=>['asset_items_destroy',$ai->id]]) !!}
			<bootstrap-modal id="deleteModal-{{ $ai->id }}">
				<template slot="header">Delete Confirmation</template>
				<template slot="body">
					Are you sure you wish to delete {{ $ai->name }}?
				</template>
				<template slot="footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Delete</button>	
				</template>
			</bootstrap-modal>
			{!! Form::close() !!}
			@endforeach
		@endif
	@endforeach
@endif
@endsection