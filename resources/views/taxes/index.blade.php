@extends('layouts.backend')
@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
@endsection
@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item active">Taxes</li>
</ol>
<div class="container-fluid">
	<bootstrap-card use-header="true" use-body="true" use-footer="true">
		<template slot="header">
			<ul class="nav nav-tabs card-header-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#current" role="tab">Current</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#history" role="tab">History</a>
				</li>
			</ul>
		</template>
		<template slot="body">
			<div class="tab-content">
				<div class="tab-pane active" id="current" role="tabpanel">
					<h4 class="card-title">Current Tax Rate</h4>
					@if (isset($current))
					<h1>
						<span class="badge badge-default">{{ $current->rate }}</span>
						<span class="badge badge-info">{{ ($current->rate *100) }}%</span>
					</h1>
			      	<p class="card-text"><small class="text-muted">Rate was set: {{ $current->created_at->diffForHumans() }}</small></p>	
			      	@else
			      		<p class="card-text">No rate has been set.</p>

			      	@endif	
				</div>
				<div class="tab-pane" id="history" role="tabpanel">
					<h4 class="card-title">Tax History</h4>
					<table class="table table-sm table-striped table-hover">
						<thead class="thead-inverse">
							<tr>
								<th>ID</th>
								<th>Rate</th>
								<th>Created</th>
							</tr>
						</thead>
						<tbody>
						@if(count($history) > 0)
							@foreach($history as $hist)
							<tr>
								<td>{{ $hist->id }}</td>
								<td>{{ $hist->rate }}</td>
								<td>{{ $hist->created_at->diffForHumans() }}</td>
							</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>
			</div>
			
		</template>
		<template slot="footer">
			<a href="{{ route('taxes_create') }}" class="btn btn-primary">Update Tax</a>
		</template>
	</bootstrap-card>
</div>
@endsection

@section('modals')

@endsection