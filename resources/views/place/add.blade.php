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
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{ (isset($place)) ? 'Editar' : 'Cadastrar'}} PoI</h4></div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!-- Display Messages -->
                    @include('common.messages')

                    <form action="{{ (isset($place)) ? url('/place/edit/'.$place->id) : url('/place')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input id="name" class="form-control" type="text" name="name" value="{{ (isset($place)) ? $place->name : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Telefone:</label>
                                <input id="phone" class="form-control" type="text" name="phone" value="{{ (isset($place)) ? $place->phone : '' }}">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="website">Website:</label>
                                <input id="website" class="form-control" type="text" name="website" value="{{ (isset($place)) ? $place->website : '' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Categoria:</label>
                                <select id="category" class="form-control">
                                    <option id="place-category" value="{{ (isset($place)) ? $place->place_type[0]->category : '' }}"></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Tipo:</label>
                                <select id="type" name="types[1][id]" class="form-control">
                                    <option id="place-type" value="{{ (isset($place)) ? $place->place_type[0]->type : '' }}"></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Endereço:</label>
                                <input id="address" class="form-control" type="text" name="address" value="{{ (isset($place)) ? $place->address : '' }}">
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

                        <input type="hidden" name="latitude" id="latitude" value="{{ (isset($place)) ? $place->latitude : '' }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ (isset($place)) ? $place->longitude : '' }}">

                        <div class="col-xs-12">
                            <div class="form-group">
                                <a href="{{ (isset($place)) ? url('/place/'.$place->id) : url('/place') }}">
                                    <button type="button" class="btn btn-default">Voltar</button>
                                </a>
                                <input type="submit" class="btn btn-primary pull-right"  value="{{ (isset($place)) ? 'Editar' : 'Cadastrar' }}">
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
