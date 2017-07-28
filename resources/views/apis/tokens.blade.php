@extends('layouts.backend')

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/views/admins/index.js') }}"></script>
@endsection

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admins_index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('apis_index') }}">Accessibility</a></li>
    <li class="breadcrumb-item active">Tokens</li>
</ol>
<div class="container-fluid">
	<passport-personal-access-tokens></passport-personal-access-tokens>
</div>


@endsection

@section('modals')

@endsection