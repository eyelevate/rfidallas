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
				<hr/>
				<!-- Pre -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->pre }}"
					use-label="true"
					b-label="Pre Fee"
				></bootstrap-readonly>
				<div id="accordion-1" role="tablist" aria-multiselectable="true">
					<div class="card">
    					<div class="card-header" role="tab" id="headingPre">
    						<p class="mb-0">
    							<a href="#collapse-1" data-toggle="collapse" data-parent="#accordion-1" aria-expanded="true" aria-controls="collapse-1">Pre Fee Breakdown</a>
    						</p>
    					</div>
    					<div id="collapse-1" class="collapse" role="tabpanel" aria-labelledby="headingPre">
    						<div class="card-block">
    							<div class="table-responsive">
									<table class="table table-sm table-striped table-hover table-bordered">
									@if (count($row->preFees) > 0)
										<thead class="">
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Desc</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
										@foreach($row->preFees as $prefee)
											<tr>
												<td>{{ $prefee->id }}</td>
												<td>{{ $prefee->name }}</td>
												<td>{{ $prefee->desc }}</td>
												<td>{{ $prefee->pretax }}</td>
											</tr>
										@endforeach
										</tbody>
										<tfoot class="">
											<tr>
												<th colspan="3" class="text-right">Qty&nbsp;</th>
												<td>{{ count($row->preFees) }}</td>
											</tr>
											<tr>
												<th colspan="3" class="text-right">Subtotal&nbsp;</th>
												<td>{{ $row->pre }}</td>
											</tr>
										</tfoot>
									@endif
									</table>
								</div>		
    						</div>
    					</div>
    				</div>
				<hr/>
				<!-- Price -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->price }}"
					use-label="true"
					b-label="Sub Rate"
				></bootstrap-readonly>
				<div id="accordion-2" role="tablist" aria-multiselectable="true">
					<div class="card">
    					<div class="card-header" role="tab" id="headingService">
    						<p class="mb-0">
    							<a href="#collapse-2" data-toggle="collapse" data-parent="#accordion-2" aria-expanded="true" aria-controls="collapse-2">Price Service Breakdown</a>
    						</p>
    					</div>
    					<div id="collapse-2" class="collapse" role="tabpanel" aria-labelledby="headingService">
    						<div class="card-block">
    							<div class="table-responsive">
									<table class="table table-sm table-striped table-hover table-bordered">
									@if (count($row->serviceFees) > 0)
										<thead class="">
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Desc</th>
												<th>Hourly</th>
												<th>Daily</th>
												<th>Weekly</th>
												<th>Monthly</th>
												<th>Yearly</th>
											</tr>
										</thead>
										<tbody>
										@foreach($row->serviceFees as $servicefee)
											<tr>
												<td>{{ $servicefee->id }}</td>
												<td>{{ $servicefee->name }}</td>
												<td>{{ $servicefee->desc }}</td>
												<td class="{{ $row->hourly ? 'bg-success' : 'bg-danger' }}">{{ $servicefee->hourly }}</td>
												<td class="{{ $row->daily ? 'bg-success' : 'bg-danger' }}">{{ $servicefee->daily }}</td>
												<td class="{{ $row->weekly ? 'bg-success' : 'bg-danger' }}">{{ $servicefee->weekly }}</td>
												<td class="{{ $row->monthly ? 'bg-success' : 'bg-danger' }}">{{ $servicefee->monthly }}</td>
												<td class="{{ $row->yearly ? 'bg-success' : 'bg-danger' }}">{{ $servicefee->yearly }}</td>
											</tr>
										@endforeach
										</tbody>
										<tfoot class="">
											<tr>
												<th colspan="7" class="text-right">Qty&nbsp;</th>
												<td>{{ count($row->serviceFees) }}</td>
											</tr>
											<tr>
												<th colspan="7" class="text-right">Subtotal (Monthly)&nbsp;</th>
												<td>{{ $row->price }}</td>
											</tr>
										</tfoot>
									@endif
									</table>
								</div>		
    						</div>
    					</div>
    				</div>
				<hr/>
				<!-- Post -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->post }}"
					use-label="true"
					b-label="Post Fee"
				></bootstrap-readonly>
				<div id="accordion-3" role="tablist" aria-multiselectable="true">
					<div class="card">
    					<div class="card-header" role="tab" id="headingPost">
    						<p class="mb-0">
    							<a href="#collapse-3" data-toggle="collapse" data-parent="#accordion-3" aria-expanded="true" aria-controls="collapse-3">Post Fee Breakdown</a>
    						</p>
    					</div>
    					<div id="collapse-3" class="collapse" role="tabpanel" aria-labelledby="headingPost">
    						<div class="card-block">
    							<div class="table-responsive">
									<table class="table table-sm table-striped table-hover table-bordered">
									@if (count($row->postFees) > 0)
										<thead class="">
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Desc</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
										@foreach($row->postFees as $postfee)
											<tr>
												<td>{{ $postfee->id }}</td>
												<td>{{ $postfee->name }}</td>
												<td>{{ $postfee->desc }}</td>
												<td>{{ $postfee->pretax }}</td>
											</tr>
										@endforeach
										</tbody>
										<tfoot class="">
											<tr>
												<th colspan="3" class="text-right">Qty&nbsp;</th>
												<td>{{ count($row->postFees) }}</td>
											</tr>
											<tr>
												<th colspan="3" class="text-right">Subtotal&nbsp;</th>
												<td>{{ $row->post }}</td>
											</tr>
										</tfoot>
									@endif
									</table>
								</div>		
    						</div>
    					</div>
    				</div>
    			</div>
    			<hr/>	

				<!-- Cancel -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->cancel }}"
					use-label="true"
					b-label="Cancel Fee"
				></bootstrap-readonly>
				<div id="accordion-4" role="tablist" aria-multiselectable="true">
					<div class="card">
    					<div class="card-header" role="tab" id="headingCancel">
    						<p class="mb-0">
    							<a href="#collapse-4" data-toggle="collapse" data-parent="#accordion-4" aria-expanded="true" aria-controls="collapse-4">Cancel Fee Breakdown</a>
    						</p>
    					</div>
    					<div id="collapse-4" class="collapse" role="tabpanel" aria-labelledby="headingCancel">
    						<div class="card-block">
    							<div class="table-responsive">
									<table class="table table-sm table-striped table-hover table-bordered">
									@if (count($row->cancelFees) > 0)
										<thead class="">
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Desc</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
										@foreach($row->cancelFees as $cancelfee)
											<tr>
												<td>{{ $cancelfee->id }}</td>
												<td>{{ $cancelfee->name }}</td>
												<td>{{ $cancelfee->desc }}</td>
												<td>{{ $cancelfee->pretax }}</td>
											</tr>
										@endforeach
										</tbody>
										<tfoot class="">
											<tr>
												<th colspan="3" class="text-right">Qty&nbsp;</th>
												<td>{{ count($row->cancelFees) }}</td>
											</tr>
											<tr>
												<th colspan="3" class="text-right">Subtotal&nbsp;</th>
												<td>{{ $row->cancel }}</td>
											</tr>
										</tfoot>
									@endif
									</table>
								</div>		
    						</div>
    					</div>
    				</div>
    			</div>
    			<hr/>

				<fieldset class="form-group">
					<label>Allow Subscription Hourly?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->hourly,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>
				<hr/>

				<fieldset class="form-group">
					<label>Allow Subscription Daily?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->daily,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>
				<hr/>

				<fieldset class="form-group">
					<label>Allow Subscription Weekly?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->weekly,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>
				<hr/>
				<fieldset class="form-group">
					<label>Allow Subscription Monthly?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->monthly,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>
				<hr/>
				<fieldset class="form-group">
					<label>Allow Subscription Yearly?</label>
					<div class="form-check">
						{{ Form::select('hourly',[0=>'No',1=>'Yes'],$row->yearly,['class'=>'custom-select','disabled'=>'true','style'=>'background-color:#ffffff;']) }}
					</div>
				</fieldset>
				<hr/>
				<!-- Start Date -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->start->format('n/d/Y') }}"
					use-label="true"
					b-label="Start Date"
				></bootstrap-readonly>
				<hr/>
				<!-- End Date -->
				<bootstrap-readonly
					use-input="true"
					b-value="{{ $row->end->format('n/d/Y') }}"
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