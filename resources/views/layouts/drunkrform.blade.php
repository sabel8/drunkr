<div class="card">
	<div class="card-header">Calculate DrunkR factor</div>
	<div class="card-body">
		<div id="calculatorError"class="alert alert-danger">
			<button type="button" class="close" onclick="$(this).parent().hide()">&times;</button>
			<span id="calculatorErrorText"></span>
		</div>
		<form>
			<div class="form-group">
				<label for="volume_value">Volume:</label>
				<input type="number" class="form-control" id="volume_value" name="volume_value">
			</div>
			<div class="form-group">
				<label for="volume_unit">Unit:</label>
				<select class="form-control" name="volume_unit" id="volume_unit">
					@foreach ($units as $unit)
						<option value="{{$unit->multiplier}}">{{$unit->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="alcohol_percent">Alcohol %:</label>
				<input type="number" class="form-control" id="alcohol_percent" name="alcohol_percent">
			</div>
			<div class="form-group">
				<label for="price">Price:</label>
				<input type="number" class="form-control" id="price" name="price">
			</div>
			<button type="button" class="btn btn-primary" id="drunkRCalculateSubmit">Submit</button>
			<span style="margin-left:15px;color:#1aaf00" id="drunkRCalculatorResult"></span>
		</form>
	</div>
</div>