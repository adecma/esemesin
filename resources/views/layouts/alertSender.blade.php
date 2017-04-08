@if(Session::has('alertSender'))
	<div class="pull-right">
		<span class="label label-success" style="font-size:14px; border-radius: 0px">
			{{ Session::get('alertSender') }}
		</span>
	</div>
@endif