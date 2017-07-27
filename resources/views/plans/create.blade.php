@extends('layouts.backend')


@section('styles')
@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/plans/create.js') }}"></script>
@endsection

@section('content')
<!-- Breadcrumb -->	
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans_index') }}">Plans</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>

<div class="container-fluid">
	<form class="" method="POST" action="{{ route('plans_store') }}">

	{{ csrf_field() }}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Create A Plan </template>
			<template slot = "body">
	            <div class="content">
	            	<!--Name-->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Name"
	                    b-placeholder="Name of plan"
	                    b-name="name"
	                    b-type="text"
	                    b-value="{{ old('name') }}"
	                    b-err="{{ $errors->has('name') }}"
	                    b-error="{{ $errors->first('name') }}"
	                    >
	                </bootstrap-input>

	                <!--Desc-->
	                <bootstrap-textarea class="form-group-no-border {{ $errors->has('desc') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Description"
	                    b-placeholder="Detailed description of plan"
	                    b-name="desc"
	                    b-type="text"
	                    b-value="{{ old('desc') }}"
	                    b-err="{{ $errors->has('desc') }}"
	                    b-error="{{ $errors->first('desc') }}"
	                    >
	                </bootstrap-textarea>

	                <!-- Pre -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('pre') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Pre service fees (Any fee issued before plan starts)"
	                    b-err="{{ $errors->has('user_id') }}"
	                    b-error="{{ $errors->first('user_id') }}"
	                    >
	                    <template slot="select">
	                    	<div class="input-group">
	                    		{{ Form::text('pre',old('pre'),['id'=>'pre','class'=>'form-control','readonly'=>'true','style'=>'background-color:#ffffff;']) }}
	                    		<span class="input-group-btn">
									<button id="pre-select" class="btn btn-secondary" type="button" data-toggle="modal" data-target="#preFeeModal">Select Pre</button>
								</span>
	                    	</div>
	                    	<div id="pre-fee-plan">
	                    		<div class="pre-fee-plan-row" v-for="pre in preFee">
	                    			<input type="hidden" :name="pre.inputName" v-model="pre.id"/>	
	                    		</div>
	                    	</div>
	                    </template>
	                    
	                </bootstrap-select>

	                <!-- Price -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('price') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Subscription Fees (monthly)"
	                    b-err="{{ $errors->has('price') }}"
	                    b-error="{{ $errors->first('price') }}"
	                    >
	                    <template slot="select">
	                    	<div class="input-group">
	                    		{{ Form::text('price',old('price'),['id'=>'price','class'=>'form-control','readonly'=>'true','style'=>'background-color:#ffffff;']) }}
	                    		<span class="input-group-btn">
									<button id="sub-select" class="btn btn-secondary" type="button" data-toggle="modal" data-target="#serviceModal">Select Subs</button>
								</span>
	                    	</div>
	                    	<div id="plan-service">
	                    		<div class="plan-service-row" v-for="s in service">
	                    			<input type="hidden" :name="s.inputName" v-model="s.id"/>	
	                    		</div>
	                    	</div>
	                    </template>
	                    
	                </bootstrap-select>

	                <!-- Post -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('post') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Post service fees (Any fee issued after plan finishes)"
	                    b-err="{{ $errors->has('post') }}"
	                    b-error="{{ $errors->first('post') }}"
	                    >
	                    <template slot="select">
	                    	<div class="input-group">
	                    		{{ Form::text('post',old('post'),['id'=>'post','class'=>'form-control','readonly'=>'true','style'=>'background-color:#ffffff;']) }}
	                    		<span class="input-group-btn">
									<button id="searchUsers" class="btn btn-secondary" type="button" data-toggle="modal" data-target="#postFeeModal">Select Post</button>
								</span>
	                    	</div>
	                    	<div id="post-fee-plan">
	                    		<div class="post-fee-plan-row" v-for="post in postFee">
	                    			<input type="hidden" :name="post.inputName" v-model="post.id"/>	
	                    		</div>
	                    	</div>
	                    </template>
	                    
	                </bootstrap-select>

	                <!-- Cancel -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('cancel') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Cancel service fees (Any fee issued if subscriber cancels plan)"
	                    b-err="{{ $errors->has('cancel') }}"
	                    b-error="{{ $errors->first('cancel') }}"
	                    >
	                    <template slot="select">
	                    	<div class="input-group">
	                    		{{ Form::text('cancel',old('cancel'),['id'=>'cancel','class'=>'form-control','readonly'=>'true','style'=>'background-color:#ffffff;']) }}
	                    		<span class="input-group-btn">
									<button id="searchUsers" class="btn btn-secondary" type="button" data-toggle="modal" data-target="#cancelModal">Select Cancel</button>
								</span>
	                    	</div>
	                    	<div id="cancel-fee-plan">
	                    		<div class="cancel-fee-plan-row" v-for="cancel in cancelFee">
	                    			<input type="hidden" :name="cancel.inputName" v-model="cancel.id"/>	
	                    		</div>
	                    	</div>
	                    </template>
	                    
	                </bootstrap-select>
	                <hr/>
	                <!-- Hourly -->
	                <bootstrap-radio class="form-group-no-border {{ $errors->has('hourly') ? ' has-danger' : '' }}"
	                	use-label="true"
	                	label="Allow Hourly Charges?"
	                	b-err="{{ $errors->has('hourly') }}"
	                	b-error="{{ $errors->first('cancel') }}"
	                >
	                	<template slot="radio">
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="hourly" checked value="1"/> 
	                			Yes
	                		</label>
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="hourly" value="0"/> 
	                			No
	                		</label>
	                	</template>

	                </bootstrap-radio>
	                <hr/>
	                <!-- Daily -->
	                <bootstrap-radio class="form-group-no-border {{ $errors->has('daily') ? ' has-danger' : '' }}"
	                	use-label="true"
	                	label="Allow Daily Charges?"
	                	b-err="{{ $errors->has('daily') }}"
	                	b-error="{{ $errors->first('daily') }}"
	                >
	                	<template slot="radio">
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="daily" checked value="1"/> 
	                			Yes
	                		</label>
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="daily" value="0"/> 
	                			No
	                		</label>
	                	</template>

	                </bootstrap-radio>
	                <hr/>
	                <!-- Weekly -->
	                <bootstrap-radio class="form-group-no-border {{ $errors->has('weekly') ? ' has-danger' : '' }}"
	                	use-label="true"
	                	label="Allow Weekly Charges?"
	                	b-err="{{ $errors->has('weekly') }}"
	                	b-error="{{ $errors->first('weekly') }}"
	                >
	                	<template slot="radio">
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="weekly" checked value="1"/> 
	                			Yes
	                		</label>
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="weekly" value="0"/> 
	                			No
	                		</label>
	                	</template>

	                </bootstrap-radio>
	                <hr/>

	                <!-- Monthly -->
	                <bootstrap-radio class="form-group-no-border {{ $errors->has('monthly') ? ' has-danger' : '' }}"
	                	use-label="true"
	                	label="Allow Monthly Charges?"
	                	b-err="{{ $errors->has('monthly') }}"
	                	b-error="{{ $errors->first('monthly') }}"
	                >
	                	<template slot="radio">
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="monthly" checked value="1"/> 
	                			Yes
	                		</label>
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="monthly" value="0"/> 
	                			No
	                		</label>
	                	</template>

	                </bootstrap-radio>
	                <hr/>
	                <!-- Yearly -->
	                <bootstrap-radio class="form-group-no-border {{ $errors->has('yearly') ? ' has-danger' : '' }}"
	                	use-label="true"
	                	label="Allow Yearly Charges?"
	                	b-err="{{ $errors->has('yearly') }}"
	                	b-error="{{ $errors->first('yearly') }}"
	                >
	                	<template slot="radio">
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="yearly" checked value="1"/> 
	                			Yes
	                		</label>
	                		<label class="form-check-label col-12">
	                			<input type="radio" class="form-check-input" name="yearly" value="0"/> 
	                			No
	                		</label>
	                	</template>

	                </bootstrap-radio>
	                <hr/>
	                <!-- Start -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('start_date') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Start Date"
	 					use-icon-post="true"
	 					b-icon-post="icon-calendar"
	                    b-placeholder="MM/DD/YYYY"
	                    b-name="start_date"
	                    b-type="text"
	                    b-value="{{ old('start_date') }}"
	                    b-err="{{ $errors->has('start_date') }}"
	                    b-error="{{ $errors->first('start_date') }}"
	                    b-input-id="start-date"
	                    >
	                </bootstrap-input>

	                <!-- End -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('end_date') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "End Date"
	 					use-icon-post="true"
	 					b-icon-post="icon-calendar"
	                    b-placeholder="MM/DD/YYYY"
	                    b-name="end_date"
	                    b-type="text"
	                    b-value="{{ old('end_date') }}"
	                    b-err="{{ $errors->has('end_date') }}"
	                    b-error="{{ $errors->first('end_date') }}"
	                    b-input-id="end-date"
	                    >
	                </bootstrap-input>
	          
		        </div>
			</template>

			<template slot = "footer">
				<a href="{{ route('companies_index') }}" class="btn btn-secondary">Back</a>
				<button type="submit" class = "btn btn-primary">Save</button>
			</template>

			
		</bootstrap-card>
	</form>	
</div>

@endsection

@section('modals')
<bootstrap-modal id="preFeeModal" b-size="modal-lg">
	<template slot="header">
		<ul class="nav nav-tabs card-header-tabs" role="tablist">
			<li class="nav-item">
				<a href="#preSelect" class="nav-link active" data-toggle="tab" role="tab">(1) Select </a>
			</li>
			<li class="nav-item">
				<a href="#preReview" class="nav-link" data-toggle="tab" role="tab">(2) Review <span class="badge badge-info" id="pre-selected-count">@{{ preFeeCount }}</span></a>
			</li>
		</ul>
	</template>
	<template slot="body">
		<div class="tab-content" style="border:none;">
			<div class="tab-pane active" role="tabpanel" id="preSelect">
				<div class="table-responsive">
					<bootstrap-table
						:columns="{{ $fee_columns }}"
						:rows="{{ $pre_fee_rows }}"
						:paginate="true"
						:global-search="true"
						:line-numbers="true"/>
					</bootstrap-table>
			    </div>
			</div>
			<div class="tab-pane" role="tabpanel" id="preReview">
				<div class="table-responsive">
					<table class="table table-sm table-hover table-bordered table-striped">
						<thead class="thead-inverse">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Fee</th>
								<th>A</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="pre in preFee">
								<td>@{{ pre.id }}</td>
								<td>@{{ pre.name }}</td>
								<td>@{{ pre.pretax }}</td>
								<td><button class="btn btn-sm btn-danger" @click="removePreFeeRow(pre.id)">Remove</button></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3"  class="text-right">Quantity&nbsp;</th>
								<td id="pre-total-quantity">@{{ preFeeCount }}</td>
							</tr>
							<tr>
								<th colspan="3" class="text-right">Subtotal&nbsp;</th>
								<td id="pre-total-subtotal">@{{ preFeeSubtotal }}</td>
							</tr>

						</tfoot>
					</table>
				</div>
			</div>
		</div>	
	</template>
	<template slot="footer">
		<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	
	</template>
</bootstrap-modal>
<bootstrap-modal id="postFeeModal" b-size="modal-lg">
	<template slot="header">
		<ul class="nav nav-tabs card-header-tabs" role="tablist">
			<li class="nav-item">
				<a href="#postFeeSelect" class="nav-link active" data-toggle="tab" role="tab">(1) Select </a>
			</li>
			<li class="nav-item">
				<a href="#postFeeReview" class="nav-link" data-toggle="tab" role="tab">(2) Review <span class="badge badge-info">@{{ postFeeCount }}</span></a>
			</li>
		</ul>
	</template>
	<template slot="body">
		<div class="tab-content" style="border:none;">
			<div class="tab-pane active" role="tabpanel" id="postFeeSelect">
				<div class="table-responsive">
					<bootstrap-table
						:columns="{{ $fee_columns }}"
						:rows="{{ $post_fee_rows }}"
						:paginate="true"
						:global-search="true"
						:line-numbers="true"/>
					</bootstrap-table>
			    </div>
			</div>
			<div class="tab-pane" role="tabpanel" id="postFeeReview">
				<div class="table-responsive">
					<table class="table table-sm table-hover table-bordered table-striped">
						<thead class="thead-inverse">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Fee</th>
								<th>A</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="post in postFee">
								<td>@{{ post.id }}</td>
								<td>@{{ post.name }}</td>
								<td>@{{ post.pretax }}</td>
								<td><button class="btn btn-sm btn-danger" @click="removePostFeeRow(post.id)">Remove</button></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3"  class="text-right">Quantity&nbsp;</th>
								<td id="post-total-quantity">@{{ postFeeCount }}</td>
							</tr>
							<tr>
								<th colspan="3" class="text-right">Subtotal&nbsp;</th>
								<td id="post-total-subtotal">@{{ postFeeSubtotal }}</td>
							</tr>

						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</template>
	<template slot="footer">
		<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	
	</template>
</bootstrap-modal>
<bootstrap-modal id="cancelModal" b-size="modal-lg">
	<template slot="header">
		<ul class="nav nav-tabs card-header-tabs" role="tablist">
			<li class="nav-item">
				<a href="#cancelSelect" class="nav-link active" data-toggle="tab" role="tab">(1) Select </a>
			</li>
			<li class="nav-item">
				<a href="#cancelReview" class="nav-link" data-toggle="tab" role="tab">(2) Review <span class="badge badge-info" id="pre-selected-count">@{{ cancelFeeCount }}</span></a>
			</li>
		</ul>
	</template>
	<template slot="body">
		<div class="tab-content" style="border:none;">
			<div class="tab-pane active" role="tabpanel" id="cancelSelect">
				<div class="table-responsive">
					<bootstrap-table
						:columns="{{ $fee_columns }}"
						:rows="{{ $cancel_fee_rows }}"
						:paginate="true"
						:global-search="true"
						:line-numbers="true"/>
					</bootstrap-table>
			    </div>
			</div>
			<div class="tab-pane" role="tabpanel" id="cancelReview">
				<div class="table-responsive">
					<table class="table table-sm table-hover table-bordered table-striped">
						<thead class="thead-inverse">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Fee</th>
								<th>A</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="cancel in cancelFee">
								<td>@{{ cancel.id }}</td>
								<td>@{{ cancel.name }}</td>
								<td>@{{ cancel.pretax }}</td>
								<td><button class="btn btn-sm btn-danger" @click="removeCancelFeeRow(cancel.id)">Remove</button></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3"  class="text-right">Quantity&nbsp;</th>
								<td id="cancel-total-quantity">@{{ cancelFeeCount }}</td>
							</tr>
							<tr>
								<th colspan="3" class="text-right">Subtotal&nbsp;</th>
								<td id="cancel-total-subtotal">@{{ cancelFeeSubtotal }}</td>
							</tr>

						</tfoot>
					</table>
				</div>
			</div>
		</div>	
	</template>
	<template slot="footer">
		<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	
	</template>
</bootstrap-modal>
<bootstrap-modal id="serviceModal" b-size="modal-lg">
	<template slot="header">
		<ul class="nav nav-tabs card-header-tabs" role="tablist">
			<li class="nav-item">
				<a href="#serviceSelect" class="nav-link active" data-toggle="tab" role="tab">(1) Select </a>
			</li>
			<li class="nav-item">
				<a href="#serviceReview" class="nav-link" data-toggle="tab" role="tab">(2) Review <span class="badge badge-info">@{{ serviceCount }}</span></a>
			</li>
		</ul>
	</template>
	<template slot="body">
		<div class="tab-content" style="border:none;">
			<div class="tab-pane active" role="tabpanel" id="serviceSelect">
				<div class="table-responsive">
					<bootstrap-table
						:columns="{{ $service_columns }}"
						:rows="{{ $service_rows }}"
						:paginate="true"
						:global-search="true"
						:line-numbers="true"/>
					</bootstrap-table>
			    </div>
			</div>
			<div class="tab-pane" role="tabpanel" id="serviceReview">
				<div class="table-responsive">
					<table class="table table-sm table-hover table-bordered table-striped">
						<thead class="thead-inverse">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Hourly</th>
								<th>Daily</th>
								<th>Weekly</th>
								<th>Monthly</th>
								<th>Yearly</th>
								<th>A</th>
							</tr>
						</thead>
						<tbody id="service-tbody">
							<tr v-for="s in service">
								<td>@{{ s.id }}</td>
								<td>@{{ s.name }}</td>
								<td>@{{ s.hourly }}</td>
								<td>@{{ s.daily }}</td>
								<td>@{{ s.weekly }}</td>
								<td>@{{ s.monthly }}</td>
								<td>@{{ s.yearly }}</td>
								<td><button class="btn btn-sm btn-danger" @click="removeServiceRow(s.id)">Remove</button></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="7"  class="text-right">Quantity&nbsp;</th>
								<td id="pre-total-quantity">@{{ serviceCount }}</td>
							</tr>
							<tr>
								<th colspan="7" class="text-right">Subtotal&nbsp;</th>
								<td id="pre-total-subtotal">@{{ serviceSubtotal }}</td>
							</tr>

						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</template>
	<template slot="footer">
		<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	
	</template>
</bootstrap-modal>
@endsection