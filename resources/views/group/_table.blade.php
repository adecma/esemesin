<div class="table-responsive">
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($groups as $group)
				<tr>
					<td>{{ $group->name }}</td>
					<td>{{ $group->description }}</td>
					<td>
						<form action="{{ route('group.destroy', $group->id) }}" method="post">
							{{ csrf_field() }}
							{{ method_field('delete') }}
							<a href="{{ route('group.show', $group->id) }}" class="btn btn-xs btn-success">Member</a>
							<a href="{{ route('group.edit', $group->id) }}" class="btn btn-xs btn-info">Edit</a>
							<button class="btn btn-xs btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

{!! $groups->links() !!}