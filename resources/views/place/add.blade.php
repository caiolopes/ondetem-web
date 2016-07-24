@extends('layouts.app')

@section('content')
    <style>
        #map {
            width: 100%;
            height: 300px;
        }
        #current {
            padding-top: 25px;
        }
    </style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Cadastrar novo local</h4></div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <form action="{{ url('place') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input id="name" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Telefone:</label>
                                <input id="phone" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="website">Website:</label>
                                <input id="website" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Categoria:</label>
                                <select id="category" class="form-control"></select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Tipo:</label>
                                <select id="type" class="form-control"></select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Endereço:</label>
                                <input id="address" class="form-control" type="text">
                                <br>
                                <input id="search" class="btn btn-default" type="button" value="Buscar">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Local (posicione o marcador no mapa):</label>
                                <div id="map"></div>
                                <div id="current">Local ainda não foi posicionado...</div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary pull-right" value="Cadastrar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        var marker = null;

        $(document).ready(function(){
            getCategories();
        });

        function getCategories() {
            $.getJSON('/categories', function(data){
                var html = '';
                $.each(data, function(index, value){
                    html+= '<option value="'+value.category+'">'+value.category+'</option>';
                });
                var category = $('#category');

                category.html(html);

                category.on('change', function() {
                    getTypes(category.val());
                });
                getTypes(category.val());
            });
        }

        function getTypes(category) {
            $.getJSON('/types?category='+category, function(data){
                var html = '';
                $.each(data, function(index, value){
                    html+= '<option value="'+value.id+'">'+value.type+'</option>';
                });
                $('#type').html(html);
            });
        }

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {lat: -34.397, lng: 150.644}
            });

            if (marker == null) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(-22.005, -47.898),
                    draggable: true
                });
            }

            map.setCenter(marker.position);
            marker.setMap(map);

            google.maps.event.addListener(marker, 'dragend', function (evt) {
                document.getElementById('current').innerHTML = '<p>O lugar foi posicionado na latitude: '
                        + evt.latLng.lat().toFixed(3) + ' e longitude: ' + evt.latLng.lng().toFixed(3) + '</p>';
            });

            google.maps.event.addListener(marker, 'dragstart', function (evt) {
                document.getElementById('current').innerHTML = '<p>Posicionando o lugar...</p>';
            });

            var geocoder = new google.maps.Geocoder();

            document.getElementById('search').addEventListener('click', function() {
                geocodeAddress(geocoder, map);
            });
        }

        function geocodeAddress(geocoder, resultsMap) {
            var address = document.getElementById('address').value;
            geocoder.geocode({'address': address}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    resultsMap.setCenter(results[0].geometry.location);
                    resultsMap.setZoom(15);
                    marker.setPosition(results[0].geometry.location);
                    resultsMap.setCenter(marker.position);
                    document.getElementById('current').innerHTML = '<p>O lugar foi posicionado na latitude: '
                            + marker.getPosition().lat().toFixed(3) + ' e longitude: ' +  marker.getPosition().lng().toFixed(3) + '</p>';
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCppnNL6ttK0K3v8U21aPO2mOvS4OgtJAs&callback=initMap"></script>
@endsection
