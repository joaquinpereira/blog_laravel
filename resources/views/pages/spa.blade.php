<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>@yield('meta-title', config('app.name'))</title>
	<meta name="description" content="@yield('meta-description', 'Este es un blog hecho en laravel')">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/framework.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/responsive.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

	@stack('styles')
</head>
<body>
	<div id="app">
		<div class="preload"></div>
		<header class="space-inter">
			<div class="container container-flex space-between">

				<figure class="logo"><img src="/img/logo.png" alt=""></figure>
				
				<nav-bar></nav-bar>

			</div>
		</header>
        

        <!-- Contenido -->
		<div class="page-wraper">
			<transition name="slide-fade" mode="out-in">
				<router-view :key="$route.fullPath"></router-view>
			</transition>
		</div>
		

        <section class="footer">
			<footer>
				<div class="container">
					<figure class="logo"><img src="/img/logo.png" alt=""></figure>
					
					<footer-nav />					
				</div>
			</footer>
		</section>
	</div>

	<script src="{{ mix('js/app.js') }}"></script>
	@stack('scripts')

</body>
</html>



	