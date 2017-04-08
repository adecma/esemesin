@push('css')
	<link rel="stylesheet" href="{{ url('vendor/selectize/selectize.bootstrap3.css') }}">
@endpush

<form action="{{ route('group.storeMember', $group->id) }}" method="POST">
	{{ csrf_field() }}

	<div class="form-group col-md-10 {{ $errors->has('member') ? 'has-error' : '' }}">
		<select name="member[]" id="member" class="form-control" multiple placeholder="Add multiple contact">
			<option value=""></option>
			@foreach($contacts as $contact)
				<option value="{{ $contact->id }}">{{ $contact->name }}</option>
			@endforeach
		</select>

		@if($errors->has('member'))
			<span class="help-block">
				{{ $errors->first('member') }}
			</span>
		@endif
	</div>

	<div class="form-group col-md-2">
		<button type="submit" class="btn btn-primary btn-block">Add</button>
	</div>
</form>

@push('js')
	<script src="{{ url('vendor/selectize/selectize.js') }}"></script>

	<script>
		$(document).ready(function(){
			$('#member').selectize();
		});
	</script>
@endpush