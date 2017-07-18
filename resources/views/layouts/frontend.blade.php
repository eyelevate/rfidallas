<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>RfiDallas</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/themes/now-ui-kit/now-ui-kit.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/themes/ionicons/ionicons.css') }}">
    <!-- Page specific styles -->
    @yield('styles')

</head>

<body class="index-page">
    <!-- Navbar -->
    @include('layouts.partials.frontend-navbar')    
    <!-- End Navbar -->
    <div id="bootstrap-root" class="wrapper">
        <!-- Start header -->
        <br/><br/>
        <div class="container">
            <header>
                @yield('header')
            </header>
            <!-- End header -->
            <!-- Start Content -->
            <div class="main">
                @include('flash::message')
                @yield('content')
            </div>    
        </div>
        
        <!-- End Content -->
        <!-- Start Modals -->
        @yield('modals')
        <!-- End Modals -->
        <!-- Start Footer -->
        <br><br>
        @include('layouts.partials.frontend-footer')
        <!-- End Footer -->
    </div>
</body>
<!--   Core JS Files   -->
<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
<!-- Theme dependencies -->
<script type="text/javascript" src="{{ mix('/js/themes/now-ui-kit/combined.js') }}"></script>

<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script type="text/javascript" src="{{ mix('/js/themes/now-ui-kit/now-ui-kit.js') }}"></script>

<!-- Page specific scripts -->
@yield('scripts')

</html>