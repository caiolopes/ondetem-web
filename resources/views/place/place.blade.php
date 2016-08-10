@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>
                    <a href="{{ url('/places') }}"><button class="btn btn-primary">Voltar</button></a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <!-- Display Validation Errors -->
                @include('common.errors')
                <!-- Display Messages -->
                @include('common.messages')
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>{{ $place->name }} <span class="badge pull-right">Votos: {{ $confirmations }}</span></h4></div>
                    <div class="panel-body">
                        @if ($place->address) <p><b>Endereço:</b> {{ $place->address }}</p> @endif
                        @if ($place->phone) <p><b>Telefone:</b> {{ $place->phone }}</p> @endif
                        <p><b>Latitude:</b> {{ $place->latitude }}</p>
                        <p><b>Longitude:</b> {{ $place->longitude }}</p>
                        <input type="hidden" id="latitude" value="{{ $place->latitude }}">
                        <input type="hidden" id="longitude" value="{{ $place->longitude }}">
                        @if ($place->website) <p><b>Website:</b> {{ $place->website }}</p> @endif <p><b>Confirmações de usuários:</b> {{ $confirmations }}</p>
                        @foreach ($place->place_type as $place_type)
                        <p><b>Categoria:</b> {{ $place_type->category }}</p>
                        <p><b>Tipo:</b> {{ $place_type->type }}</p>
                        @endforeach
                        <div id="map" class="map"></div>
                        <br>
                        <p>
                            <b>Você confirma as informações desse lugar?</b>
                            <a href="{{ url('/place/confirm?place='.$place->id."&exists=1") }}"><button class="btn btn-success">Sim</button></a>
                            <a href="{{ url('/place/confirm?place='.$place->id."&exists=0") }}"><button class="btn btn-danger">Não</button></a>
                        </p>
                        <div class="well pull-right">
                            <h4>Ações:</h4>
                            <a href="{{ url('/place/edit/'.$place->id) }}">
                                <button class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>
                            </a>
                            <button data-href="{{ url('/place/delete/'.$place->id) }}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Deletar</h4>
                </div>
                <div class="modal-body">
                    Você irá deletar o ponto de interesse <b>{{ $place->name }}</b>, tem certeza?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger btn-ok">Deletar</a>
                </div>
            </div>
        </div>
    </div>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCppnNL6ttK0K3v8U21aPO2mOvS4OgtJAs&callback=initMap"></script>
@endsection
