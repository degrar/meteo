{{--  We are using sections to force the content generation BEFORE the <head> render
      in order use the pre_body_closed stack. --}}
@section('body_content')
	<header class="header">
	<div class="main_menu_toggle">@widget('Content\Navigation', ['simple_scroll' => true])</div>
		<div class="main_menu_fixed">
			<a href="{{ $home }}"><img class="svg" src="../img/logo.svg" /></a>
			<span>
				<nav class="lang_sel">
				    <a href="{{ $change_language }}">{{ $lang_code_string }}</a>
				</nav>
			<span>
		</div>
	</header>
	<section class="privacy_policy">
		<h1 class="title">{{ $content->title }}</h1>
		<div class="separation_line"></div>
		{!! $content->content !!}
	</section>
	@stack('pre_body_closed')
@stop

<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<!-- styles -->
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/app.css">
	<link rel="stylesheet" type="text/css" href="../css/privacy-cookies.css">
	<!-- scripts -->
	<script src="http://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
	@stack('pre_head_closed')
	<link rel="stylesheet" type="text/css" href="../css/app.css">
</head>
<body>
	@yield('body_content')
</body>
@stack('post_body_closed')
</html>