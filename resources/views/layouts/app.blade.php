<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DrunkR') }} - less is the best</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/calculator.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>
    class Place {
        constructor(id, name, latitude, longitude) {
            this.id = id;
            this.name = name;
            this.latitude = latitude;
            this.longitude = longitude;
        }

        setPlaceModalBodyHTML() {
            $('#placeModalBody').html('<div class="spinner-border text-primary"></div>');
            $.ajax({
                type: 'post',
                url: '/drinksOfPlace',
                data: {
                    'id': this.id
                },
                //dataType: 'json',//return data will be json
                success: function (data) {
                    $('#placeModalBody').html(createDrinkTable(data));
                },
                error: function (xhr) {
                    console.log(xhr);
                    if (xhr.status == 401) {
                        $('#placeModalBody').html("You have to be logged in to be able to see the drinks...");
                    } else {
                        $('#placeModalBody').html("There was an error fetching the drinks.");
                    }
                }
            });
        }
    }

    function initPlaces(places) {
        var initPlacesArray = [];
        for (let i = 0; i < places.length; i++) {
            const place = places[i];
            initPlacesArray[place.id] = new Place(place.id, place.name, place.latitude, place.longitude);
        }
        return initPlacesArray;
    }
    </script>

    {{-- more special config attributes --}}
    @yield('head')
</head>

<body>
    <nav id="top-navbar" class="navbar navbar-expand-sm bg-info navbar-dark" style="margin-bottom:30px">
        <a class="navbar-brand" href="#">DrunkR</a>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/map') }}">Map</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/me/drinks') }}">My drinks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
    @yield('content')
</body>
</html>
