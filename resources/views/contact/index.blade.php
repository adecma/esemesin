@extends('layouts.app')

@section('content')
	<div class="col-md-8">
		<div class="panel">
			<div class="panel-heading">
				Contact
				@include('layouts.alert')
			</div>

			<div class="panel-body">
				<div class="row">
					@include('contact._form')
				</div>
					
				@if(count($contacts))
					@include('contact._table')
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