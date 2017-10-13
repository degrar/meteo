{{--  We are using sectins to force the content generation BEFORE the <head> render
      in order use the pre_body_closed stack. --}}
@section('body_content')
	<header class="header">@include('header')</header>
	<section class="section1">@widget('Content\Slider', ['slider_code'=>'top'])</section>
	<section class="section2">@widget('Content\AboutUs')</section>
	<section class="section3">@widget('Content\Slider', ['slider_code'=>'about_us'])</section>
	<section class="section4">@widget('Content\Services')</section>
	<section class="section5">@widget('Content\Team')</section>
	<section class="section6">@widget('Content\ContactUs')</section>
	<section class="section7">@widget('Content\Map')</section>
	@widget('Footer')
	@stack('pre_body_closed')
@stop

<!DOCTYPE html>
<html>
<head>
	<title>Implantis - Clinica dental las Palmas de Gran Canaria</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!-- TODO: Change in production -->
	<meta name="description" content="Tu clínica dental de confianza en las Palmas de Gran Canaria. Implantes, periodoncia, estética dental, cirugía oral, etc.. Realiza tu consulta sin compromiso.">
	<!-- styles -->
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<!-- scripts -->
	<script src="http://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
	<script src="/js/external/touchSwipe/jquery.touchSwipe.min.js"></script>
	@stack('pre_head_closed')
	<link rel="stylesheet" type="text/css" href="css/app.css">
</head>
<body>
	@yield('body_content')
	<!-- POLITICA DE COOKIES -->
	@if($show_cookies_message)
	<div id="cookies_header" class="cookies_header">
		<p>{!! trans('web.cookies_popup') !!}</p>
		<a id="cookie_cross" onclick="javacript: PonerCookie();">
			<svg width="34px" height="32px" viewBox="0 0 34 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<g id="Group-2" transform="translate(1.000000, 0.000000)" stroke="#FFF">
						<g id="Page-1">
							<path d="M0.3536,0.3535 L31.8896,31.8895" id="Stroke-1"></path>
							<path d="M31.8893,0.3536 L0.3533,31.8896" id="Stroke-3"></path>
						</g>
					</g>
				</g>
			</svg>
		</a>
	</div>
	@endif
</body>
@stack('post_body_closed')
</html>
