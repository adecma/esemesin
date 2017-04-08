<form action="#" method="get">
	<div class="form-group {{ $errors->has('search') ? 'has-error' : '' }}">
		<input name="search" class="form-control" placeholder="Keyword">{{ old('search') }}</textarea>

		@if($errors->has('search'))
			<span class="help-block">
				{{ $errors->first('search') }}
			</span>
		@endif
	</div>
</form>