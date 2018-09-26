<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- or was displaying 1 in front for code below --}}
        <title>{{ isset($title) ? $title : 'Laravel Project' }}</title>

		{{-- Fonts --}}
        @include('layouts.partials._fonts')

        {{-- Styles --}}
        @include('layouts.partials._styles')

        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <div class="wrapper">
            @yield('header')
        
            @yield('content')
        </div>

    	<footer>
    		@yield('footer')
    	</footer>

    	{{-- Scripts --}}
		@include('layouts.partials._scripts')
    </body>
</html>