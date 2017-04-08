@if(Route::currentRouteName() == 'contact.edit')
	<form action="{{ route('contact.update', $contact->id) }}" method="post">
	{{ method_field('put') }}
@else
	<form action="{{ route('contact.store') }}" method="POST">
@endif
	{{ csrf_field() }}
	<div class="form-group col-md-5 {{ $errors->has('name') ? 'has-error' : '' }}">
		<input type="text" name="name" class="form-control" id="" placeholder="Name" value="{{ old('name', $contact->name ?? '') }}">
		@if($errors->has('name'))
			<span class="help-block">
				{{ $errors->first('name') }}
			</span>
		@endif
	</div>

	<div class="form-group col-md-5 {{ $errors->has('phoneNumber') ? 'has-error' : '' }}">
		<div class="input-group">
			<span class="input-group-addon">+</span>
			<input type="text" name="phoneNumber" class="form-control" id="" placeholder="628 xx xxxx xxxx" value="{{ old('phoneNumber', $contact->phoneNumber ?? '') }}">
		</div>

		@if($errors->has('phoneNumber'))
			<span class="help-block">
				{{ $errors->first('phoneNumber') }}
			</span>
		@endif
	</div>

	<div class="form-group col-md-2">
		<button type="submit" class="btn btn-primary btn-block">Save</button>
	</div>
</form>