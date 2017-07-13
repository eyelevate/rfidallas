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
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/now-ui-kit.css') }}">
    <!-- CSS Just for demo purpose, don't include it in your project -->
<!--     <link href="./assets/css/demo.css" rel="stylesheet" /> -->
</head>

<body class="index-page">
    <!-- Navbar -->
    @include('layouts.partials.frontend-navbar')    
    <!-- End Navbar -->
    <div class="wrapper">
        <!-- Start header -->
        <div class="page-header clear-filter" filter-color="orange">
            @yield('header')
        </div>
        <!-- End header -->
        <!-- Start Content -->
        <div class="main">
            @yield('content')
        </div>
        <!-- End Content -->
        <!-- Start Modals -->
        @yield('modals')
        <!-- End Modals -->
        <!-- Start Footer -->
        @include('layouts.partials.frontend-footer')
        <!-- End Footer -->
    </div>
</body>
<!--   Core JS Files   -->
<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
<!-- Theme dependencies -->
<script type="text/javascript" src="{{ mix('/js/combined.js') }}"></script>

<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script type="text/javascript" src="{{ mix('/js/now-ui-kit.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // the body of this function is in assets/js/now-ui-kit.js
        nowuiKit.initSliders();
    });

    function scrollToDownload() {

        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    }
</script>

</html>