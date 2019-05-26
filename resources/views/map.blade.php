@extends('layouts.app')
@section('head')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css" />
    <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/map.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
	<div class="card">
		<div class="card-body">
			<div id="mapContainer" class="here-maps card-body"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="placeModal">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
	  
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="placeModalTitle">Modal Heading</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
		
			<!-- Modal body -->
			<div class="modal-body" id="placeModalBody">
				Modal body..
			</div>
		
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
	  
		</div>
	</div>
</div>


{{-- Marker objects --}}
<script>
	var places = @json($places);
</script>
@endsection