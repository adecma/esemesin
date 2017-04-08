@extends('layouts.app')

@section('content')
	<div class="col-md-8">
		<div class="panel">
			<div class="panel-heading">
				Message
				@include('layouts.alert')
			</div>

			<div class="panel-body">					
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th width="20%">To</th>
								<th>Message</th>
								<th width="15%">Date</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									{{ $message->contact->name }}
									<br>
									{{ $message->to }}
									<form action="{{ route('message.destroy', $message->id) }}" method="post">
										{{ csrf_field() }}
										{{ method_field('delete') }}
										<button class="btn btn-xs btn-danger" type="submit">Delete</button>
									</form>
								</td>
								<td>{{ $message->body }}</td>
								<td>{{ $message->created_at->diffForHumans() }}</td>
							</tr>
						</tbody>
					</table>
				</div>

				<hr>
				
				@php
					$response = json_decode($message->response, true);
				@endphp

				
				@foreach($response['messages'] as $data)

					<dl class="dl-horizontal">
						<dt>message-id</dt>
						<dd>{{ $data['message-id'] }}</dd>
						<dt>status</dt>
						<dd>{{ $data['status'] == '0' ? 'Success' : $data['status'] }}</dd>
						<dt>message-price</dt>
						<dd>&euro;{{ number_format($data['message-price'], 4) }}</dd>
						<dt>network</dt>
						<dd>{{ $data['network'] }}</dd>
						<dt>info</dt>
						<dd>Source {{ $response['info'] }}</dd>
					</dl>
				@endforeach
			</div>
		</div>
	</div>

	<div class="col-md-4">
		@include('layouts.sidebar.search')
		@include('layouts.sidebar.sendSms')
	</div>
@endsection