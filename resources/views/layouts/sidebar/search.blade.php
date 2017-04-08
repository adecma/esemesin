@php
	if($routeName == 'contact.index' || $routeName == 'contact.edit') {
		$url = $urlForm['contact'];
	} elseif ($routeName == 'group.index' || $routeName == 'group.edit') {
		$url = $urlForm['group'];
	} else {
		$url = $urlForm['message'];
	}
@endphp

<div class="panel">
	<div class="panel-heading">Search</div>
	<div class="panel-body">
		<form action="{{ $url }}" method="get">
			<div class="form-group">
				<input name="search" class="form-control" value="{{ request()->input('search') }}" placeholder="Keyword">
			</div>
		</form>
	</div>
</div>