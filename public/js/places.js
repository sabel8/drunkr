const iconGreenSvgMarkup = `<svg xmlns="http://www.w3.org/2000/svg" width="28px" height="36px" 
	style="cursor: pointer;margin: -32px 0px 0px -14px; z-index: 0; transform: matrix(1, 0, 0, 1, 702, 576); position: absolute;">
	<path d="M 19 31 C 19 32.7 16.3 34 13 34 C 9.7 34 7 32.7 7 31 C 7 29.3 9.7 28 13 28 C 16.3 28 19 29.3 19 31 Z"
	 fill="#000" fill-opacity=".2"></path>
	 <path d="M 13 0 C 9.5 0 6.3 1.3 3.8 3.8 C 1.4 7.8 0 9.4 0 12.8 C 0 16.3 1.4 19.5 3.8 21.9 L 13 31 L 22.2 21.9
	  C 24.6 19.5 25.9 16.3 25.9 12.8 C 25.9 9.4 24.6 6.1 22.1 3.8 C 19.7 1.3 16.5 0 13 0 Z" fill="#fff"></path>
	  <path d="M 13 2.2 C 6 2.2 2.3 7.2 2.1 12.8 C 2.1 16.1 3.1 18.4 5.2 20.5 L 13 28.2 L 20.8 20.5 C 22.9 18.4
         23.8 16.2 23.8 12.8 C 23.6 7.07 20 2.2 13 2.2 Z" fill="#34d32c"></path></svg>`;
const iconBlueSvgMarkup = `<svg xmlns="http://www.w3.org/2000/svg" width="28px" height="36px" 
style="cursor: pointer;margin: -32px 0px 0px -14px; z-index: 0; transform: matrix(1, 0, 0, 1, 702, 576); position: absolute;">
<path d="M 19 31 C 19 32.7 16.3 34 13 34 C 9.7 34 7 32.7 7 31 C 7 29.3 9.7 28 13 28 C 16.3 28 19 29.3 19 31 Z"
fill="#000" fill-opacity=".2"></path>
<path d="M 13 0 C 9.5 0 6.3 1.3 3.8 3.8 C 1.4 7.8 0 9.4 0 12.8 C 0 16.3 1.4 19.5 3.8 21.9 L 13 31 L 22.2 21.9
C 24.6 19.5 25.9 16.3 25.9 12.8 C 25.9 9.4 24.6 6.1 22.1 3.8 C 19.7 1.3 16.5 0 13 0 Z" fill="#fff"></path>
<path d="M 13 2.2 C 6 2.2 2.3 7.2 2.1 12.8 C 2.1 16.1 3.1 18.4 5.2 20.5 L 13 28.2 L 20.8 20.5 C 22.9 18.4
    23.8 16.2 23.8 12.8 C 23.6 7.07 20 2.2 13 2.2 Z" fill="#18d"></path></svg>`;

function createDrinkTable(drinks) {
    drinks = JSON.parse(drinks);
    if (drinks.length == 0) {
        return "This place does not have any recorded drinks.";
    }
    var html = `<table class="table table-striped"><thead>
				<tr>
					<th>Name</th>
					<th>Type</th>
					<th>DrunkR factor</th>
				</tr>
			</thead>
			<tbody>`;
    drinks.forEach(drink => {
        html += '<tr><td>' + drink.name + '</td><td>' + drink.typeName + '</td><td>' + Math.round(drink.drunkRFactor * 100) / 100 + '</td></tr>';
    });
    html += '</tbody></table>';
    return html;
}

var initPlacesArray = [];
for (let i = 0; i < places.length; i++) {
    const place = places[i];
    initPlacesArray[place.id] = new Place(place.id, place.name, place.latitude, place.longitude);
}
var places = initPlacesArray;


var platform = new H.service.Platform({
    'app_id': 'gqkkZi7dMxyp19vU806D',
    'app_code': 'GUwSA7k7zNSXrFsX2AegbA'
});

// Obtain the default map types from the platform object:
var defaultLayers = platform.createDefaultLayers();

// Instantiate (and display) a map object:
map = new H.Map(
    $('#placeSelector')[0],
    defaultLayers.normal.map, {
        zoom: 10,
        center: {
            lat: 47.497912,
            lng: 19.040235
        }
    }
);
// Instantiate the default behavior, providing the mapEvents object:

// Enable the event system on the map instance:
var mapEvents = new H.mapevents.MapEvents(map);
var behavior = new H.mapevents.Behavior(mapEvents);
var ui = H.ui.UI.createDefault(map, defaultLayers);
var predefinedMarkersGroup = new H.map.Group();
map.addObject(predefinedMarkersGroup);
var selectedMarkerGroup = new H.map.Group();
map.addObject(selectedMarkerGroup);

places.forEach(place => {
    var placeMarker = new H.map.DomMarker({
        lat: place.latitude,
        lng: place.longitude
    }, {
        icon: new H.map.DomIcon(iconBlueSvgMarkup)
    });
    placeMarker.addEventListener('tap', function (evt) {
        selectPlace(evt, placeMarker, true, place.name);
    });
    predefinedMarkersGroup.addObject(placeMarker);
});


// add 'tap' event listener, that opens info bubble, to the group
map.addEventListener('tap', function (evt) {
    selectPlace(evt, null, false, null);
}, false);



function deselectMarker() {
    selectedMarkerGroup.removeAll();
    predefinedMarkersGroup.getObjects().forEach(place => {
        place.setIcon(new H.map.DomIcon(iconBlueSvgMarkup));
    });
}

function selectPlace(evt, markerObject, isPredefinedPlace, placeName) {
    deselectMarker();
    var clickedCoordinates;
    if (isPredefinedPlace === true) {
        clickedCoordinates = markerObject.getPosition();
        evt.stopPropagation();
        markerObject.setIcon(new H.map.DomIcon(iconGreenSvgMarkup));
    } else {
        clickedCoordinates = map.screenToGeo(evt.currentPointer.viewportX, evt.currentPointer.viewportY);
        var clickedMarker = new H.map.DomMarker(clickedCoordinates, {
            icon: new H.map.DomIcon(iconGreenSvgMarkup)
        });
        selectedMarkerGroup.addObject(clickedMarker);
    }
    setPlaceFormValue(clickedCoordinates, placeName);
    map.setCenter(clickedCoordinates, true);
}

function setPlaceFormValue(coordinates, placeName) {
    $("#place_latitude").val(coordinates.lat);
    $("#place_longitude").val(coordinates.lng);
    if (placeName !== null) {
        $("#place_name").val(placeName).prop('disabled', true);
    } else {
        $("#place_name").val("").prop('disabled', false);
    }
}