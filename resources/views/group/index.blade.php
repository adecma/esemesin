@extends('layouts.app')

@section('content')
	<div class="col-md-8">
		<div class="panel">
			<div class="panel-heading">
				Group
				@include('layouts.alert')
			</div>

			<div class="panel-body">
				<div class="row">
					@include('group._form')
				</div>
				
				@if(count($groups))
					@include('group._table')
				@else
					<hr>
					<p class="text-center">
						Empty data
					</p>
				@endif
			</div>
		</div>
	</div>

	<div class="col-md-4">
		@include('layouts.sidebar.search')
		@include('layouts.sidebar.sendSms')
	</div>
@endsection