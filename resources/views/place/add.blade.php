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
                                <input id="name" class="form-control" type="text" name="name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Telefone:</label>
                                <input id="phone" class="form-control" type="text" name="phone">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="website">Website:</label>
                                <input id="website" class="form-control" type="text" name="website">
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
                                <select id="type" name="types[1][id]" class="form-control"></select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Endereço:</label>
                                <input id="address" class="form-control" type="text" name="address">
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

                        <input type="hidden" name="latitude" id="latitude" value="">
                        <input type="hidden" name="longitude" id="longitude" value="">

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
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCppnNL6ttK0K3v8U21aPO2mOvS4OgtJAs&callback=initMap"></script>
@endsection
