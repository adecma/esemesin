@if(Session::has('alert'))
	<div class="pull-right">
		<span class="label label-success" style="font-size:14px; border-radius: 0px">
			{{ Session::get('alert') }}
		</span>
	</div>
@endif