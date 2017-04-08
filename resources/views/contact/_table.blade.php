<div class="table-responsive">
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Phone Number</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($contacts as $contact)
				<tr>
					<td>{{ $contact->name }}</td>
					<td>{{ $contact->phoneNumber }}</td>
					<td>
						<form action="{{ route('contact.destroy', $contact->id) }}" method="post">
							{{ csrf_field() }}
							{{ method_field('delete') }}
							<a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-xs btn-info">Edit</a>
							<button class="btn btn-xs btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

{!! $contacts->links() !!}