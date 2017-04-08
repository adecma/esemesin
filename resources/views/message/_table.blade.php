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
			@foreach($messages as $message)
				<tr>
					<td>
						{{ $message->contact->name }}
						<br>
						{{ $message->to }}
						<form action="{{ route('message.destroy', $message->id) }}" method="post">
							{{ csrf_field() }}
							{{ method_field('delete') }}
							<a href="{{ route('message.show', $message->id) }}" class="btn btn-xs btn-success">Detail</a>
							<button class="btn btn-xs btn-danger" type="submit">Delete</button>
						</form>
					</td>
					<td>
						{{ $message->body }} <br><br>
						<code>Source {{ json_decode($message->response, true)['info'] }}</code>
					</td>
					<td>{{ $message->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

{!! $messages->links() !!}