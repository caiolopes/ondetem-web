@extends('layouts.app')

@section('content')

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

                    <form class="repeater" action="{{ (isset($place->id)) ? url('/place/edit/'.$place->id) : url('/place')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input id="name" class="form-control" type="text" name="name" value="{{ (isset($place->name)) ? $place->name : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Telefone:</label>
                                <input id="phone" class="form-control" type="text" name="phone" value="{{ (isset($place->phone)) ? $place->phone : '' }}">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="website">Website:</label>
                                <input id="website" class="form-control" type="text" name="website" value="{{ (isset($place->website)) ? $place->website : '' }}">
                            </div>
                        </div>

                        <div data-repeater-list="types">
                            @if (isset($place->place_type))
                                @for ($i = 0; $i < count($place->place_type); $i++)
                                    <div data-repeater-item>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="category">Categoria:</label>
                                                <select id="category" class="category form-control">
                                                    <option class="place-category" value="{{ $place->place_type[$i]->category }}">{{ $place->place_type[$i]->category }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="type">Tipo:</label>
                                                <select id="type" name="types[{{$i}}][id]" class="type form-control">
                                                    <option id="place-type" class="place-type" value="{{ $place->place_type[$i]->type }}">{{ $place->place_type[$i]->type }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <br>
                                            <input data-repeater-delete class="form-control" type="button" value="Deletar"/>
                                            <br>
                                        </div>
                                    </div>
                                @endfor
                            @else
                                <div data-repeater-item>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="category">Categoria:</label>
                                            <select id="category" class="category form-control">
                                                <option class="place-category" value=""></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="type">Tipo:</label>
                                            <select id="type" name="types[0][id]" class="type form-control">
                                                <option class="place-type" value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <input data-repeater-delete class="form-control" type="button" value="Deletar"/>
                                        <br>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-2 pull-right">
                            <div class="form-group">
                                <input class="form-control" data-repeater-create type="button" value="Adicionar"/>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Endereço:</label>
                                <input id="address" class="form-control" type="text" name="address" value="{{ (isset($place->address)) ? $place->address : '' }}">
                                <br>
                                <input id="search" class="btn btn-default" type="button" value="Buscar">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Local (posicione o marcador no mapa):</label>
                                <div id="map" class="map"></div>
                                <div id="current" style="padding-top: 25px;">Local ainda não foi posicionado...</div>
                            </div>
                        </div>

                        <input type="hidden" name="latitude" id="latitude" value="{{ (isset($place->latitude)) ? $place->latitude : '' }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ (isset($place->longitude)) ? $place->longitude : '' }}">

                        <div class="col-xs-12">
                            <div class="form-group">
                                <a href="{{ (isset($place->id)) ? url('/place/'.$place->id) : url('/place') }}">
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
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6wG7WcXrAQEWak1WwSa0KsncShVojbdU&callback=initMap"></script>
@endsection
