<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

        <!-- Latest compiled and minified CSS -->
        @section('stylesheet')

      <link rel="stylesheet" href="/semantic/semantic.min.css">
			<link rel="stylesheet" href="/semantic/calendar.min.css">
    		<link rel="stylesheet" href="/css/animate.css" charset="utf-8">
    		<link rel="stylesheet" href="/css/hover.css" charset="utf-8">
            <link rel="stylesheet" href="/css/admin.css">
            <link href="/fonts/MerriweatherSans-LightItalic.ttf" rel="stylesheet">
            <link href="/fonts/BadScript-Regular.ttf" rel="stylesheet">

        @show



    </head>
	<script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <body>

        {{-- <div class="ui bottom attached segment pushable"> --}}
            @yield('content')
        {{-- </div> --}}

	{{-- Javascript Files --}}
    @section('javascript')
    	<script src="/js/jquery.min.js"></script>
    	<script src="/semantic/semantic.min.js"></script>
    	<script src="/semantic/calendar.min.js"></script>
    	<script src="/js/admin.js"></script>
    @show
	</body>

</html>
