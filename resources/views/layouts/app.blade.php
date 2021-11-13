<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Title -->
		<title>{{ config('app.name') }} Sistema de gestión documental</title>

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="/lib/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/lib/animate.css/animate.min.css">
		<link rel="stylesheet" href="/lib/jscrollpane/jquery.jscrollpane.css">
		<link rel="stylesheet" href="/lib/waves/waves.min.css">
		<link rel="stylesheet" href="/lib/chartist/chartist.min.css">
		<link rel="stylesheet" href="/lib/switchery/dist/switchery.min.css">
		<link rel="stylesheet" href="/lib/morris/morris.css">
		<link rel="stylesheet" href="/lib/jvectormap/jquery-jvectormap-2.0.3.css">
        <link rel="stylesheet" href="/lib/typicons/src/font/typicons.min.css">
        <link rel="stylesheet" href="/lib/dropify/dist/css/dropify.min.css">

		<!-- Neptune CSS -->
		<link rel="stylesheet" href="/css/core.css">
        <script type="text/javascript" src="/lib/chartjs/Chart.bundle.min.js"></script>

		<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

		<![endif]-->

		@yield("css")

	</head>
	<body class="large-sidebar fixed-sidebar fixed-header content-appear">
		<div class="wrapper">
        @if(Auth::check())
            @include("nav.sidebar")

        <div class="panelOp">
            @include("nav.nav")



            @yield('content')
        </div>

        @else

            @yield('content')

        @endif
        <!-- Footer -->
            <footer class="footer site-content" style="padding-top:5px !important;">
                <div class="container-fluid">
                    2020 © {{ config('app.name') }}
                </div>
            </footer> 
        </div>
          

		<script type="text/javascript" src="/lib/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="/lib/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="/lib/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/lib/detectmobilebrowser/detectmobilebrowser.js"></script>
		<script type="text/javascript" src="/lib/jscrollpane/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="/lib/jscrollpane/mwheelIntent.js"></script>
		<script type="text/javascript" src="/lib/jscrollpane/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="/lib/waves/waves.min.js"></script>
		<script type="text/javascript" src="/lib/chartist/chartist.min.js"></script>
		<script type="text/javascript" src="/lib/switchery/dist/switchery.min.js"></script>
		<script type="text/javascript" src="/lib/flot/jquery.flot.min.js"></script>
		<script type="text/javascript" src="/lib/flot/jquery.flot.resize.min.js"></script>
		<script type="text/javascript" src="/lib/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
		<script type="text/javascript" src="/lib/CurvedLines/curvedLines.js"></script>
		<script type="text/javascript" src="/lib/TinyColor/tinycolor.js"></script>
		<script type="text/javascript" src="/lib/sparkline/jquery.sparkline.min.js"></script>
		<script type="text/javascript" src="/lib/raphael/raphael.min.js"></script>
		<script type="text/javascript" src="/lib/morris/morris.min.js"></script>
		<script type="text/javascript" src="/lib/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
		<script type="text/javascript" src="/lib/jvectormap/jquery-jvectormap-world-mill.js"></script>
		<script type="text/javascript" src="/lib/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript" src="/lib/dropify/dist/js/dropify.min.js"></script>

		<!-- Neptune JS -->
		<script type="text/javascript" src="/js/config.js"></script>
		<script type="text/javascript" src="/js/site.js"></script>
		<script type="text/javascript" src="/js/app.js"></script>
		@yield("script")
	</body>
</html>