@push('css')
	<link rel="stylesheet" href="{{ url('vendor/selectize/selectize.bootstrap3.css') }}">
@endpush

@if($balance)
	<div class="panel">
		<div class="panel-body">
			<p>Balance Remaining</p>
			<h4>
				&euro;{{ number_format($balance, 4) }} / 
				{{ number_format($balance/0.026, 2) }} sms
			</h4>
		</div>
	</div>
@endif

@php
	if($routeName == 'group.index' || $routeName == 'group.show') {
		$url = $urlForm['group'];
		$datas = $dataGroups;
	} else {
		$url = $urlForm['contact'];
		$datas = $dataContacts;
	}
@endphp
<div class="panel">
	<div class="panel-heading">
		Send SMS
		@include('layouts.alertSender')
	</div>
	<div class="panel-body">
		<form action="{{ $url }}" method="POST">
			{{ csrf_field() }}

			<div class="form-group {{ $errors->has('to') ? 'has-error' : '' }}">
				<select name="to" id="to" class="form-control" placeholder="Send to ...">
					<option value=""></option>
					@foreach($datas as $data)
						@if(old('to') == $data->no)
							<option value="{{ $data->no }}" selected>{{ $data->name }}</option>
						@else
							<option value="{{ $data->no }}">{{ $data->name }}</option>
						@endif
					@endforeach
				</select>

				@if($errors->has('to'))
					<span class="help-block">
						{{ $errors->first('to') }}
					</span>
				@endif
			</div>

			<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				<textarea name="body" id="textarea" class="form-control" rows="5" placeholder="Contents">{{ old('body') }}</textarea>

				@if($errors->has('body'))
					<span class="help-block">
						{{ $errors->first('body') }}
					</span>
				@endif
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Send Now</button>
			</div>
		</form>
	</div>
</div>

@push('js')
	<script src="{{ url('vendor/selectize/selectize.js') }}"></script>

	<script>
		$(document).ready(function(){
			$('#to').selectize();
		});
	</script>
@endpush