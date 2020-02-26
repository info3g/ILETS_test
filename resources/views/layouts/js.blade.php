@php
 $jsFiles = [
 	"js/validate.js", 	
 	"admin_theme/app-assets/js/core/libraries/jquery.min.js",
	"admin_theme/app-assets/vendors/js/ui/tether.min.js",
	"admin_theme/app-assets/js/core/libraries/bootstrap.min.js",
	"admin_theme/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js",
	"admin_theme/app-assets/vendors/js/ui/unison.min.js",
	"admin_theme/app-assets/vendors/js/ui/blockUI.min.js",
	"admin_theme/app-assets/vendors/js/ui/jquery.matchHeight-min.js",
	"admin_theme/app-assets/vendors/js/ui/screenfull.min.js",
	"admin_theme/app-assets/vendors/js/extensions/pace.min.js",
	"admin_theme/app-assets/vendors/js/charts/chart.min.js",
	"admin_theme/app-assets/js/core/app-menu.js",
	"admin_theme/app-assets/js/core/app.js",
	"admin_theme/app-assets/js/scripts/documentation.js",
	"admin_theme/app-assets/vendors/js/ui/affix.js",
	"admin_theme/app-assets/js/scripts/pages/dashboard-lite.js",
	"admin_theme/assets/js/custom.js",
 ];
@endphp

@foreach($jsFiles as $file)
	<script src="{{asset($file)}}" type="text/javascript"></script>
@endforeach


