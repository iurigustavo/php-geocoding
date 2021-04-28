@extends('adminlte::page')

@section('content')
    <style>
        #map-canvas {
            height: 700px;
            margin: 0px;
            padding: 0px
        }

        #pan
    </style>

    <script>
        let map;

        function initMap() {
            var directionsService = new google.maps.DirectionsService();
            var directionsDisplay = new google.maps.DirectionsRenderer();

            map = new google.maps.Map(document.getElementById("map-canvas"), {
                center: {lat: {{$routes['origin']['lat']}}, lng: {{$routes['origin']['lng']}}},
                zoom: 12,
            });

            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById('left-panel'));
            var origin = new google.maps.LatLng({{$routes['origin']['lat']}}, {{$routes['origin']['lng']}});
            var destination = new google.maps.LatLng({{$routes['destination']['lat']}}, {{$routes['destination']['lng']}});
            const waypts = [];

            @foreach($routes['waypoints'] as $value)
            waypts.push({
                location: new google.maps.LatLng({{$value['lat']}}, {{$value['lng']}}),
                stopover: true
            });
            @endforeach

            var request = {
                origin: origin,
                destination: destination,
                waypoints: waypts,
                optimizeWaypoints: true,
                language: 'pt-BR',
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function (response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                }
            });
        }
    </script>

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="fas fa-car mr-1"></i>
                        Direções
                    </h3>
                </div>
                <div class="card-body">
                    <div id="left-panel" style="float: right;  max-height: 700px; overflow-y: auto; "></div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card bg-gradient-primary">
                <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        Mapa
                    </h3>
                </div>
                <div class="card-body">
                    <div id="map-canvas"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <a href="{!! route('routes.show',$route->id) !!}" class="btn btn-danger font-weight-bolder text-uppercase">Voltar</a>
    </div>
@endsection

@section('js')
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
            src="https://maps.googleapis.com/maps/api/js?key={{config('googlemaps.key')}}&callback=initMap&libraries=&v=weekly"
            async
    ></script>
@endsection