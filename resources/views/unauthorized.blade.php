<div class=”title m-b-md”>
	@if(Auth::user()['role'] != 'admin')
		You cannot access this page! This is for only Admin
	@else
		You cannot access this page! This is for only User
	@endif
</div>