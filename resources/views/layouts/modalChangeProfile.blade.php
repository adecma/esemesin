<div class="modal fade" tabindex="-1" id="modalChangeProfile">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Change Profile</h4>
			</div>
			<form action="{{ route('home.changeProfile') }}" method="post">
				{{ csrf_field() }}
				{{ method_field('put') }}
				<input type="hidden" name="currentUrl" value="{{ URL::current() }}">
				<div class="modal-body">
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						<input type="text" value="{{ old('name', Auth::user()->name) }}" class="form-control" name="name" placeholder="Your Name">
						@if($errors->has('name'))
							<span class="help-block">
								{{ $errors->first('name') }}
							</span>
						@endif
					</div>

					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<input type="email" value="{{ old('email', Auth::user()->email) }}" class="form-control" name="email" placeholder="Your Email">
						@if($errors->has('email'))
							<span class="help-block">
								{{ $errors->first('email') }}
							</span>
						@endif
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

@push('js')
	<script>
		$(document).ready(function(){
			if({!! json_encode($errors->has('name')) !!} || {!! json_encode($errors->has('email')) !!}) {
				$('#modalChangeProfile').modal('show');
			}
		});
	</script>
@endpush