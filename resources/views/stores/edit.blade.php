@extends('layouts.backend')


@section('styles')

@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/stores/create.js') }}"></script>
@endsection

@section('content')
<!-- Breadcrumb -->	
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('stores_index') }}">Stores</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>

<div class="container-fluid">
	{!! Form::open(['method'=>'patch','route'=>['stores_update',$store->id]]) !!}

		<bootstrap-card use-header = "true" use-body="true" use-footer = "true">
			
			<template slot = "header"> Edit Store </template>
			<template slot = "body">
	            <div class="content">

	            	
	            	
	            	<!--Name-->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Name"
	                    b-placeholder="Store Name"
	                    b-name="name"
	                    b-type="text"
	                    b-value="{{ old('name') ? old('name') : $store->name }}"
	                    b-err="{{ $errors->has('name') }}"
	                    b-error="{{ $errors->first('name') }}"
	                    >
	                </bootstrap-input>

					<!--Nick Name -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('nick_name') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Nick Name (optional)"
	                    b-placeholder="Nick name to describe vendor"
	                    b-name="nick_name"
	                    b-type="text"
	                    b-value="{{ old('nick_name') ? old('nick_name') : $store->nick_name }}"
	                    b-err="{{ $errors->has('nick_name') }}"
	                    b-error="{{ $errors->first('nick_name') }}"
	                    >
	                </bootstrap-input>


					<!-- Phone -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('phone') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Phone"
	                    b-placeholder="Phone"
	                    b-name="phone"
	                    b-type="text"
	                    b-value="{{ old('phone') ? old('phone') : $store->phone }}"
	                    b-err="{{ $errors->has('phone') }}"
	                    b-error="{{ $errors->first('phone') }}"
	                    >
	                </bootstrap-input>

	                <!-- Phone -->
	              	<bootstrap-input class="form-group-no-border {{ $errors->has('phone_option') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Second Phone (optional)"
	                    b-placeholder="fax\mobile etc.."
	                    b-name="phone_option"
	                    b-type="text"
	                    b-value="{{ old('phone_option') ? old('phone_option') : $store->phone_option }}"
	                    b-err="{{ $errors->has('phone_option') }}"
	                    b-error="{{ $errors->first('phone_option') }}"
	                    >
	                </bootstrap-input>

	                <!-- Street -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('street') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Street"
	                    b-placeholder="Street Address"
	                    b-name="street"
	                    b-type="text"
	                    b-value="{{ old('street') ? old('street') : $store->street }}"
	                    b-err="{{ $errors->has('street') }}"
	                    b-error="{{ $errors->first('street') }}"
	                    >
	                </bootstrap-input>

	                <!-- Suite -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('suite') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Suite (optional)"
	                    b-placeholder="Suite / Apt # / Building # / Etc.."
	                    b-name="suite"
	                    b-type="text"
	                    b-value="{{ old('suite') ? old('suite') : $store->suite }}"
	                    b-err="{{ $errors->has('suite') }}"
	                    b-error="{{ $errors->first('suite') }}"
	                    >
	                </bootstrap-input>

	                <!-- City -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('city') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "City"
	                    b-placeholder="City"
	                    b-name="city"
	                    b-type="text"
	                    b-value="{{ old('city') ? old('city') : $store->city }}"
	                    b-err="{{ $errors->has('city') }}"
	                    b-error="{{ $errors->first('city') }}"
	                    >
	                </bootstrap-input>

	                <!-- State -->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('state') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "State"
	                    b-err="{{ $errors->has('state') }}"
	                    b-error="{{ $errors->first('state') }}"
	                    >
	                    <template slot="select">
	                    	{{ Form::select('state',$states,old('state') ? old('state') : $store->state,['class'=>'custom-select']) }}	
	                    </template>
	                    
	                </bootstrap-select>
	                <!-- Country-->
	                <bootstrap-select class="form-group-no-border {{ $errors->has('country') ? ' has-danger' : '' }}"
	                    use-label = "true"
	 					label = "Country"
	                    b-err="{{ $errors->has('country') }}"
	                    b-error="{{ $errors->first('country') }}"
	                    >
	                    <template slot="select">
	                    	{{ Form::select('country',$countries,old('country') ? old('country') : $store->country,['class'=>'custom-select']) }}	
	                    </template>
	                    
	                </bootstrap-select>

	                <!-- Zipcode -->
	                <bootstrap-input class="form-group-no-border {{ $errors->has('zipcode') ? ' has-danger' : '' }}" 
	                    use-label = "true"
	 					label = "Zipcode"
	                    b-placeholder="zipcode"
	                    b-name="zipcode"
	                    b-type="text"
	                    b-value="{{ old('zipcode') ? old('zipcode') : $store->zipcode }}"
	                    b-err="{{ $errors->has('zipcode') }}"
	                    b-error="{{ $errors->first('zipcode') }}"
	                    >
	                </bootstrap-input>

	                <!-- Store Hours -->
	                <hr/>
	                <label>Store Hours</label>
	                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#storehoursModal">Set Store Hours</button>
	                <bootstrap-modal id="storehoursModal" b-size="modal-lg">
					<template slot="header">Set Store Hours</template>
					<template slot="body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Day</th>
										<th>Open</th>
										<th>Open Hour</th>
										<th>Open Mins</th>
										<th>Open AM/PM</th>
										<th>Closed Hour</th>
										<th>Closed Mins</th>
										<th>Closed AM/PM</th>
									</tr>
								</thead>
								<tbody>
									@if (count($store->hours) > 0)
										@foreach($store->hours as $shkey => $shvalue)
										<tr class="{{ ($shvalue->status == 'closed') ? 'table-active' : '' }}">
											<td>{{ $days[$shkey] }}</td>
											<td>
												<select class="form-control status" name="hours[{{$shkey}}][status]" @change="setClosed($event)">
													@foreach($open as $key => $value)
													<option value="{{ $key }}" {{ ($key == $shvalue->status) ? 'selected' : '' }}>{{ $value }}</option>
													@endforeach
												</select>
											</td>
											<td>
												<select class="form-control open-hours" name="hours[{{$shkey}}][open_hours]" {{ ($shvalue->status == 'closed') ? 'readonly' : '' }}>
													@foreach($hours as $key => $value)
													<option value="{{ $key }}" {{ ($key == $shvalue->open_hours) ? 'selected' : '' }}>{{ $value }}</option>
													@endforeach
												</select>
											</td>
											<td>
												<select class="form-control open-minutes" name="hours[{{$shkey}}][open_minutes]" {{ ($shvalue->status == 'closed') ? 'readonly' : '' }}>
													@foreach($minutes as $key => $value)
													<option value="{{ $key }}" {{ ($key == $shvalue->open_minutes) ? 'selected' : '' }}>{{ $value }}</option>
													@endforeach
												</select>
											</td>
											<td>
												<select class="form-control open-ampm" name="hours[{{$shkey}}][open_ampm]" {{ ($shvalue->status == 'closed') ? 'readonly' : '' }}>
													@foreach($ampm as $key => $value)
													<option value="{{ $key }}" {{ ($key == $shvalue->open_ampm) ? 'selected' : '' }}>{{ $value }}</option>
													@endforeach
												</select>
											</td>
											<td>
												<select class="form-control closed-hours" name="hours[{{$shkey}}][closed_hours]" {{ ($shvalue->status == 'closed') ? 'readonly' : '' }}>
													@foreach($hours as $key => $value)
													<option value="{{ $key }}" {{ ($key == $shvalue->closed_hours) ? 'selected' : '' }}>{{ $value }}</option>
													@endforeach
												</select>
											</td>
											<td>
												<select class="form-control closed-minutes" name="hours[{{$shkey}}][closed_minutes]" {{ ($shvalue->status == 'closed') ? 'readonly' : '' }}>
													@foreach($minutes as $key => $value)
													<option value="{{ $key }}" {{ ($key == $shvalue->closed_minutes) ? 'selected' : '' }}>{{ $value }}</option>
													@endforeach
												</select>
											</td>
											<td>
												<select class="form-control closed-ampm" name="hours[{{$shkey}}][closed_ampm]" {{ ($shvalue->status == 'closed') ? 'readonly' : '' }}>
													@foreach($ampm as $key => $value)
													<option value="{{ $key }}" {{ ($key == $shvalue->closed_ampm) ? 'selected' : '' }}>{{ $value }}</option>
													@endforeach
												</select>
											</td>
										</tr>
										@endforeach
									@endif
								</tbody>
							</table>
					    </div>
					</template>
					<template slot="footer">
						<button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button id="closeModal" type="button" class="btn btn-primary" data-dismiss="modal">Finished</button>
					</template>
				</bootstrap-modal>
	                <hr/>
	          
		        </div>
			</template>

			<template slot = "footer">
				<a href="{{ route('stores_index') }}" class="btn btn-secondary">Back</a>
				<button type="submit" class = "btn btn-primary">Save</button>
			</template>

			
		</bootstrap-card>
	{!! Form::close() !!}
</div>

@endsection

@section('modals')

@endsection