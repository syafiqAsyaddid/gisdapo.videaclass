<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <title>SATARI</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('./css/styles-index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('./css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('./bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('./bootstrap/js/bootstrap.bundle.min.js') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/qgis2web.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet-search.css') }}">
	<style type="text/css">
	#map {
				width: 100%;
				height: 100%;
				padding: 0;
				margin: 10px;
		}
	</style>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light  navbar-style" style="background-color: #717B86FF;">
			<div class="container-fluid">
			<a class="navbar-brand" href="#">
			<img src="{{ asset('./images/logotrans.png') }}" alt="" width="30" height="35">
			</a>
				<a class="navbar-brand" href="#" style="color: #ffff;">SATARI</a>
				<button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<x-layout-navbar-kcd />
				</div>
			</div>
		</nav>

{{ $slot }}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</body>
</html>
