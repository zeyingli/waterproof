<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="ios">
<head>
    <title>{{ config('app.name', 'Waterproof@State College') }} @if (trim($__env->yieldContent('site_title')))@yield('site_title') @endif</title>

    <meta charset="utf-8">
    {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
  	<meta name="apple-mobile-web-app-status-bar-style" content="default">
  	<meta name="theme-color" content="#2196f3">
    <meta http-equiv="Content-Security-Policy" content="default-src * 'self' 'unsafe-inline' 'unsafe-eval' data: gap:">

    <meta name="author" content="Waterproof - Zeying L.">

    <meta name="description" content="@if (trim($__env->yieldContent('site_description')))@yield('site_description') @endif">

    {{-- SEO Meta --}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ config('app.name', 'Waterproof@State College') }} @if (trim($__env->yieldContent('site_title')))@yield('site_title') @endif">
    <meta name="twitter:description" content="@if (trim($__env->yieldContent('site_description')))@yield('site_description') @endif">
    <meta name="twitter:site" content="@Waterproof">
    <meta name="twitter:image" content="{{ config('app.cdn', 'https://cdn.zeyingli.com/waterproof/') }}" />
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name', 'Waterproof@StateCollege') }} @if (trim($__env->yieldContent('site_title')))@yield('site_title') @endif" />
    <meta property="og:description" content="@if (trim($__env->yieldContent('site_description')))@yield('site_description') @endif" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('app.name', 'Waterproof@StateCollege') }} | @if (trim($__env->yieldContent('site_title')))@yield('site_title') @endif" />
    <meta property="og:image" content="{{ config('app.cdn', 'https://cdn.zeyingli.com/waterproof/') }}" />

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ config('app.cdn') }}images/favicon/apple-touch-icon.png?version={{ config('app.version') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ config('app.cdn') }}images/favicon/apple-touch-icon.png?version={{ config('app.version') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ config('app.cdn') }}images/favicon/favicon-32x32.png?version={{ config('app.version') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ config('app.cdn') }}images/favicon/favicon-16x16.png?version={{ config('app.version') }}">
	<link rel="manifest" href="{{ config('app.cdn') }}images/favicon/site.webmanifest?version={{ config('app.version') }}">
	<link rel="mask-icon" href="{{ config('app.cdn') }}images/favicon/safari-pinned-tab.svg?version={{ config('app.version') }}" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">

    {{-- CSS/Misc --}}
    <link href="{{ mix('/css/webapp.css') }}" rel="stylesheet" id="theme">

    {{-- Optimization --}}
    <link rel="canonical"  href="{{ url()->current() }}" />
    <link rel='dns-prefetch' href="{{ config('app.cdn', 'https://cdn.zeyingli.com/waterproof/') }}" />

    {{-- Google Tag Manager --}}
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-ML52ZRJ');</script>

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
		function Waterproof() {}
		Waterproof.token = "{{ csrf_token() }}";
	</script>

</head>

<body class="color-theme-blue push-content-right theme-light">
	{{-- Google Tag Manager (noscript) --}}
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML52ZRJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

	<div class="loader justify-content-center">
        <div class="maxui-roller align-self-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
	<div class="wrapper">
		@guest
			@yield('login')
		@else

		@yield('verification')
        @yield('recharge')

		{{-- Sidebar Menu --}}
		<div class="sidebar sidebar-left">
			<div class="profile-link">
				<a href="javascript:void(0)" class="media">
                    <div class="w-auto h-100">
                        <figure class="avatar avatar-40"><img src="{{ config('app.cdn') }}images/user.png"> </figure>
                    </div>
                    <div class="media-body">
                        <h5>
                            {{ Auth::user()->name }}
                            @if(!empty(Auth::user()->email_verified_at)) 
                                <i class="icon material-icons md-18">verified_user</i>
                            @endif
                        </h5>
                        <p>Member since {{ Auth::user()->created_at }}</p>
                    </div>
                </a>
            </div>

            <nav class="navbar">
                <ul class="navbar-nav">
                	<li class="nav-item">
                        <a href="{{ url('/dashboard') }}" class="sidebar-close">
                            <div class="item-title">
                                <i class="material-icons">dashboard</i> Dashboard
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/account') }}" class="sidebar-close">
                            <div class="item-title">
                                <i class="material-icons">account_circle</i> My Account
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/help') }}" class="sidebar-close">
                            <div class="item-title">
                                <i class="material-icons">live_help</i> Live Help
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="profile-link text-center">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline-white btn-block px-3">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="page">
        	{{-- Header --}}
        	<header class="row m-0 fixed-header no-shadow">
        		<div class="left">
                    <a href="javascript:void(0)" class="menu-left"><i class="material-icons">menu</i></a>
                </div>
                <div class="col center">
                    <a href="{{ url('/dashboard') }}" class="logo">
                        <figure><img src="{{ config('app.cdn') }}images/black-logo.png" alt="Waterproof"></figure> Waterproof&#64;StateCollege
                    </a>
                </div>
            </header>

        	@yield('content')
        </div>
		@endguest

	</div>
	
	{{-- Scripts --}}
	<script src="{{ mix('/js/webapp.js') }}"></script>

	{{-- @if(config('settings.googleMapsAPIStatus'))
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('settings.googleMapsAPIKey') }}&libraries=places&dummy=.js" async defer></script>
    @endif --}}

	@yield('footer_scripts')

</body>

</html>








