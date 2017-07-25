@extends('layouts.backend')


@section('styles')

@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/assets/issues.js') }}"></script>

@endsection

@section('content')
<!-- Breadcrumb -->	
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('assets_index') }}">Assets</a></li>
    <li class="breadcrumb-item active">Issues</li>
</ol>
<div class="container-fluid">
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">
			<ul class="nav nav-tabs card-header-pills">
				<li class="nav-item">
					<a href="#tab-generated" role="tab" class="nav-link active" data-toggle="tab">Generated <span class="badge badge-danger">{{ count($generated) }}</span></a>
				</li>
				<li class="nav-item">
					<a href="#tab-claimed" role="tab" class="nav-link" data-toggle="tab">Claimed <span class="badge badge-warning">{{ count($claimed) }}</span></a>
				</li>
				<li class="nav-item">
					<a href="#tab-resolved" role="tab" class="nav-link" data-toggle="tab">Resolved <span class="badge badge-success">{{ count($resolved) }}</span></a>
				</li>
			</ul>
		</template>
		<template slot="body">
			<div class="tab-content">
				<div class="tab-pane active" id="tab-generated" role="tabpanel">
					<div class="table-responsive">
						<bootstrap-table
							:columns="{{ $columns }}"
							:rows="{{ $row_generated }}"
							:paginate="true"
							:global-search="true"
							:line-numbers="true"/>
						</bootstrap-table>
					</div>
				</div>
				<div class="tab-pane" id="tab-claimed" role="tabpanel">
					<div class="table-responsive">
						<bootstrap-table
							:columns="{{ $columns }}"
							:rows="{{ $row_claimed }}"
							:paginate="true"
							:global-search="true"
							:line-numbers="true"/>
						</bootstrap-table>
					</div>
				</div>
				<div class="tab-pane" id="tab-resolved" role="tabpanel">
					<div class="table-responsive">
						<bootstrap-table
							:columns="{{ $columns }}"
							:rows="{{ $row_resolved }}"
							:paginate="true"
							:global-search="true"
							:line-numbers="true"/>
						</bootstrap-table>
					</div>
				</div>

			</div>
		</template>
		<template slot="footer">
			
		</template>
	</bootstrap-card>	
</div>


@endsection

@section('modals')
@if (isset($row_generated))
	@foreach ($row_generated as $rg)
	{!! Form::open(['method'=>'patch','route'=>['asset_items_claimed',$rg->id]]) !!}
	<bootstrap-modal id="generatedModal-{{ $rg->id }}" class="modalA">
		<template slot="header">Claim Issue</template>
		<template slot="body">
			<h6><span class="badge badge-info">1</span> Send Issue To: <small>Keep empty to select yourself</small></h6>
			<bootstrap-table
				id="claimed-table-{{ $rg->id }}"
				class="claimed-table"
				:columns="{{ $admin_columns }}"
				:rows="{{ $admin_rows }}"
				:paginate="true"
				:global-search="true"/>
			</bootstrap-table>
			<hr>
			<h6><span class="badge badge-info">2</span> Confirm Current User Selected:</h6>
			<input id="claimedConfirmedInput-{{ $rg->id }}" type="text" readonly="true" class="form-control claimedConfirmedInput" value="{{ Auth::user()->email }} (You)"/>
			{{ Form::hidden('id',Auth::user()->id,['id'=>'claimedInput-'.$rg->id,'class'=>'claimedInput']) }}
		</template>
		<template slot="footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-success">Claim</button>	
		</template>
	</bootstrap-modal>
	{!! Form::close() !!}
	@endforeach
@endif
@if (isset($row_claimed))
	@foreach ($row_claimed as $rc)
	{!! Form::open(['method'=>'patch','route'=>['asset_items_resolved',$rc->id]]) !!}
	<bootstrap-modal id="claimedModal-{{ $rc->id }}" class="modalB">
		<template slot="header">
			<ul class="nav nav-tabs card-header-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#overview-{{ $rc->id }}" role="tab">Resolve Status</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#history-{{ $rc->id }}" role="tab">History <span class="badge badge-info">{{ count($rc->assetItemHistoryIssueClaimed) }}</a>
				</li>
			</ul>
		</template>
		<template slot="body">
			<div class="tab-content" style="border:none;">
				<div class="tab-pane active" id="overview-{{ $rc->id }}" role="tabpanel">
					<bootstrap-select 
						use-label="true"
						label="Resolution Update">
						<template slot="select">
							{{ Form::select('reason_status',$resolutions,'',['class'=>'form-control']) }}
						</template>
					</bootstrap-select>
					<bootstrap-textarea
						use-label="true"
						label="Detailed Explaination"
						b-name="detail"
					></bootstrap-textarea>
				</div>
				<div class="tab-pane" id="history-{{ $rc->id }}">
					<div class="list-group">
					@if (count($rc->assetItemHistoryIssueClaimed))
						@foreach($rc->assetItemHistoryIssueClaimed as $aih)

						<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
							<div class="d-flex w-100 justify-content-between">
								<h3 class="mb-1"><span class="badge badge-warning">{{ $aih->convertTypeToText($aih->type)['text'] }}</span></h3>
								<small>{{ $aih->created_at->diffForHumans() }}</small>
							</div>
							@if (is_string($aih->detail) && is_array(json_decode($aih->detail, true)) && (json_last_error() == JSON_ERROR_NONE))

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
			</div>
			
		</template>
		<template slot="footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-info">Update Status</button>	
		</template>
	</bootstrap-modal>
	{!! Form::close() !!}
	@endforeach
@endif
@if (isset($row_resolved))
	@foreach ($row_resolved as $rr)
	
	<bootstrap-modal id="resolvedModal-{{ $rr->id }}" class="modalD">
		<template slot="header">Resolved Issues</template>
		<template slot="body">
			{!! Form::open(['method'=>'patch','route'=>['asset_items_complete',$rr->id]]) !!}
			{{ Form::hidden('status',2) }}
			<h6>Re-deploy asset back to company</h6>
			<button type="submit" class="btn btn-block btn-primary">Re-deploy</button>
			{!! Form::close() !!}
			<hr/>
			{!! Form::open(['method'=>'patch','route'=>['asset_items_complete',$rr->id]]) !!}
			{{ Form::hidden('status',1) }}
			<h6>Send asset back to us. Make status - <span class="badge badge-success">Available</span></h6>
			<button type="submit" class="btn btn-block btn-success">Make Available</button>
			{!! Form::close() !!}
			<hr/>
			{!! Form::open(['method'=>'patch','route'=>['asset_items_complete',$rr->id]]) !!}
			{{ Form::hidden('status',6) }}
			<h6>Send asset back to vendor</h6>
			<button type="submit" class="btn btn-block btn-danger">Send to Vendor</button>
			{!! Form::close() !!}
		</template>
		<template slot="footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<a href="{{ route('asset_items_edit',$rr->id) }}" class="btn btn-primary">Edit</a>
		</template>
	</bootstrap-modal>
	
	@endforeach
@endif
@endsection