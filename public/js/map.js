//required config for the ajax requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



function createDrinkTable(drinks) {
    drinks = JSON.parse(drinks);
    if (drinks.length == 0) {
        return "This place does not have any recorded drinks. <a href='http://drunkr.com/me/drinks#drink_name'>Add one!</a>";
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
        html += '<tr><td>' + drink.name + '</td><td>' + drink.typeName + '</td><td>' +
            Math.round(drink.drunkRFactor * 100) / 100 + '</td></tr>';
    });
    html += '</tbody></table>';
    return html;
}


var places = initPlaces(places);

var platform = new H.service.Platform({
    'app_id': 'gqkkZi7dMxyp19vU806D',
    'app_code': 'GUwSA7k7zNSXrFsX2AegbA'
});

// Obtain the default map types from the platform object:
var defaultLayers = platform.createDefaultLayers();

var map, behavior, ui, placesGroup;

//get parameter from URL
var jumpToPlaceID = new URL(window.location.href).searchParams.get("place");

showMapBudapest();


function showMapBudapest() {
    if (jumpToPlaceID != null) {
        if (places[jumpToPlaceID] != null) {
            var latitude = places[jumpToPlaceID].latitude,
                longitude = places[jumpToPlaceID].longitude;
        } else {
            alert('There was an error displaying the place you wanted.');
            var latitude = 47.497912,longitude = 19.040235;
        }
    } else {
        var latitude = 47.497912,longitude = 19.040235;
    }
    setupHereMap(latitude, longitude);
}

function setupHereMap(latitude, longitude) {
    // Instantiate (and display) a map object:
    map = new H.Map(
        $('#mapContainer')[0],
        defaultLayers.normal.map, {
            zoom: jumpToPlaceID != null && places[jumpToPlaceID] != null?15:10,
            center: {
                lat: latitude == null ? 47.497912 : latitude,
                lng: longitude == null ? 19.040235 : longitude
            }
        }
    );

    // Instantiate the default behavior, providing the mapEvents object: 
    behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    ui = H.ui.UI.createDefault(map, defaultLayers);
    placesGroup = new H.map.Group();
    map.addObject(placesGroup);
}



// Define a variable holding SVG mark-up that defines an icon image:
var svgMarkup = `<svg xmlns="http://www.w3.org/2000/svg" width="28px" height="36px" 
	style="cursor: pointer;margin: -32px 0px 0px -14px; z-index: 0; transform: matrix(1, 0, 0, 1, 702, 576); position: absolute;">
	<path d="M 19 31 C 19 32.7 16.3 34 13 34 C 9.7 34 7 32.7 7 31 C 7 29.3 9.7 28 13 28 C 16.3 28 19 29.3 19 31 Z"
	 fill="#000" fill-opacity=".2"></path>
	 <path d="M 13 0 C 9.5 0 6.3 1.3 3.8 3.8 C 1.4 7.8 0 9.4 0 12.8 C 0 16.3 1.4 19.5 3.8 21.9 L 13 31 L 22.2 21.9
	  C 24.6 19.5 25.9 16.3 25.9 12.8 C 25.9 9.4 24.6 6.1 22.1 3.8 C 19.7 1.3 16.5 0 13 0 Z" fill="#fff"></path>
	  <path d="M 13 2.2 C 6 2.2 2.3 7.2 2.1 12.8 C 2.1 16.1 3.1 18.4 5.2 20.5 L 13 28.2 L 20.8 20.5 C 22.9 18.4
       23.8 16.2 23.8 12.8 C 23.6 7.07 20 2.2 13 2.2 Z" fill="#34d32c"></path></svg>`;

// Add the marker to the palces group on the map
map.addObject(placesGroup);

places.forEach(place => {

    var icon = new H.map.DomIcon(svgMarkup);
    var coords = {
            lat: place.latitude,
            lng: place.longitude
        },
        marker = new H.map.DomMarker(coords, {
            icon: icon
        });
    placesGroup.addObject(marker);
    marker.setData(place);
});


// add 'tap' event listener, that opens info bubble, to the group
placesGroup.addEventListener('tap', function (evt) {
    var clickedPlace = evt.target;
    // event target is the marker itself, group is a parent event target
    // for all objects that it contains
    var bubble = new H.ui.InfoBubble(clickedPlace.getPosition(), {
        // read custom data
        content: clickedPlace.getData().name + "<br><a href='#' onclick='showPlace(" +
            clickedPlace.getData().id + ")'>Show more...</a>"
    });
    // show info bubble
    ui.addBubble(bubble);
    map.setCenter(evt.target.getPosition(), true)
}, false);


function showPlace(placeID) {
    const clickedPlace = places[placeID];
    $('#placeModalTitle').text(clickedPlace.name);
    clickedPlace.setPlaceModalBodyHTML();
    $("#placeModal").modal();
}