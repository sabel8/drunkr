@section('head')
	<script src="{{ asset('js/places.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css" />
    <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
	<script src="http://js.api.here.com/v3/3.0/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8" defer>
		var places = @json($places);
	</script>
@endsection

<div class="card">
	<div class="card-header">Calculate DrunkR factor</div>
	<div class="card-body">
		
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<div id="calculatorError"class="alert alert-danger">
			<button type="button" class="close" onclick="$(this).parent().hide()">&times;</button>
			<span id="calculatorErrorText"></span>
		</div>
		<form method="POST" action="{{ route('drinks.store') }}">
			@csrf

			<div class="form-group">
				<label for="drink_name">Name:</label>
				<input type="text" class="form-control" id="drink_name" name="drink_name" required>
			</div>
			
			<div class="form-group">
				<label for="drink_type">Type:</label>
				<input list="drink_type" value="" name="drink_type" class="custom-select custom-select-md" required>
				<datalist id="drink_type">
					@foreach ($drinkTypes as $drinkType)
						<option value='{{$drinkType->name}}'>						
					@endforeach
				</datalist>
			</div>

			<div class="form-group">
				<label for="volume_value">Volume:</label>
				<input type="number" class="form-control" id="volume_value" name="volume_value" min="0" step=".01" required>
			</div>

			

			<div class="form-group">
				<label for="volume_unit">Unit:</label>
				<select class="form-control" name="volume_unit" id="volume_unit" required>
					@foreach ($units as $unit)
						<option value="{{$unit->id}}">{{$unit->name}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="alcohol_percent">Alcohol %:</label>
				<input type="number" class="form-control" id="alcohol_percent" name="alcohol_percent" min="0" step=".01" required>
			</div>

			<div class="form-group">
				<label for="price">Price:</label>
				<input type="number" class="form-control" id="price" name="price" required>
			</div>

			<div class="form-group">
				<label for="place_name">Place: (click on the place you want to save)</label>
				<input type="text" class="form-control" id="place_name" name="place_name" style="margin-bottom: 20px">
				<div id="placeSelector" class="here-maps"></div>
			</div>

			<input type="hidden" id="place_longitude" name="place_longitude" required>
			<input type="hidden" id="place_latitude" name="place_latitude" required>

			<button type="submit" class="btn btn-primary" id="drunkRSubmit">Submit</button>
		</form>
	</div>
</div>