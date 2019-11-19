@if (session()->has('status'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
		{{ session()->get('status') }}
	</div>
@endif
@if (session()->has('status-danger'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
		{{ session()->get('status-danger') }}
	</div>
@endif
