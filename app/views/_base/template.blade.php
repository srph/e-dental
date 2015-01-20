<!DOCTYPE html>
<html>
<head>
	<title> @yield('title') </title>
	<meta charset="utf-8">

	{{ HTML::style('assets/bootstrap/dist/css/bootstrap.min.css') }}
	{{ HTML::style('assets/ionicons/css/ionicons.min.css') }}
	@yield('style')
</head>
<body>
	@yield('content')

	{{ HTML::script('assets/jquery/dist/jquery.min.js') }}
	{{ HTML::script('assets/bootstrap/dist/js/bootstrap.min.js') }}
	@yield('scripts')
</body>
</html>