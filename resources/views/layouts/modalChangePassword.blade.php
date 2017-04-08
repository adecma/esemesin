<div class="modal fade" tabindex="-1" id="modalChangePassword">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Change Password</h4>
			</div>
			<form action="{{ route('home.changePassword') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="currentUrl" value="{{ URL::current() }}">
				<div class="modal-body">
					<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
						<input type="password" class="form-control" name="password" placeholder="New Password">
						@if($errors->has('password'))
							<span class="help-block">
								{{ $errors->first('password') }}
							</span>
						@endif
					</div>

					<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
						<input type="password" class="form-control" name="password_confirmation" placeholder="Confirmation Password">
						@if($errors->has('password_confirmation'))
							<span class="help-block">
								{{ $errors->first('password_confirmation') }}
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
			if({!! json_encode($errors->has('password')) !!} || {!! json_encode($errors->has('password_confirmation')) !!}) {
				$('#modalChangePassword').modal('show');
			}
		});
	</script>
@endpush