@php
	$cssFiles = [
		"admin_theme/app-assets/css/bootstrap.css",
		"admin_theme/app-assets/fonts/icomoon.css",
		"admin_theme/app-assets/fonts/flag-icon-css/css/flag-icon.min.css",
		"admin_theme/app-assets/vendors/css/extensions/pace.css",
		"admin_theme/app-assets/css/bootstrap-extended.css",
		"admin_theme/app-assets/css/app.css",
		"admin_theme/app-assets/css/colors.css",
		"admin_theme/app-assets/css/core/menu/menu-types/vertical-menu.css",
		"admin_theme/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css",
		"admin_theme/app-assets/vendors/css/documentation.css",
		"admin_theme/assets/css/style.css",
		"css/custom.css",
	];
@endphp

@foreach($cssFiles as $file)
	<link rel="stylesheet" type="text/css" href="{{asset($file)}}">
@endforeach