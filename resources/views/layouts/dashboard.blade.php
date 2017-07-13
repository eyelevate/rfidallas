<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>RfiDallas Admin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/paper-dashboard.css') }}">

    <!-- Bootstrap core CSS     -->


    <!-- Animation library for notifications   -->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/animate.min.css') }}">


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/themify-icons.css') }}">

</head>
<body>

<div class="wrapper">
	@yield('sidebar')
    

    <div class="main-panel">
    	@include('layouts.partials.dashboard-nav')
        


        <div class="content">
            @yield('content')
        </div>


        @include('layouts.partials.dashboard-footer')

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    <!-- dependencies -->
    <script type="text/javascript" src="{{ mix('/js/paper-dashboard-plugins.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script type="text/javascript" src="{{ mix('/js/paper-dashboard.js') }}"></script>



</html>
