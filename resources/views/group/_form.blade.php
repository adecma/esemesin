@if(Route::currentRouteName() == 'group.edit')
	<form action="{{ route('group.update', $group->id) }}" method="post">
	{{ method_field('put') }}
@else
	<form action="{{ route('group.store') }}" method="POST">
@endif
	{{ csrf_field() }}
	<div class="form-group col-md-5 {{ $errors->has('name') ? 'has-error' : '' }}">
		<input type="text" name="name" class="form-control" id="" placeholder="Name" value="{{ old('name', $group->name ?? '') }}">
		@if($errors->has('name'))
			<span class="help-block">
				{{ $errors->first('name') }}
			</span>
		@endif
	</div>

	<div class="form-group col-md-5 {{ $errors->has('description') ? 'has-error' : '' }}">
		<div class="input-group">
			<span class="input-group-addon">+</span>
			<input type="text" name="description" class="form-control" id="" placeholder="Description" value="{{ old('description', $group->description ?? '') }}">
		</div>

		@if($errors->has('description'))
			<span class="help-block">
				{{ $errors->first('description') }}
			</span>
		@endif
	</div>

	<div class="form-group col-md-2">
		<button type="submit" class="btn btn-primary btn-block">Save</button>
	</div>
</form>