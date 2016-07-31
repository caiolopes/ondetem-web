@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <!-- Display Messages -->
            @include('common.messages')
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{ $place->name }} <span class="badge pull-right">{{ $confirmations }}</span></h4></div>
                <div class="panel-body">
                    @if ($place->address) <p><b>Endereço:</b> {{ $place->address }}</p> @endif
                    @if ($place->phone) <p><b>Telefone:</b> {{ $place->phone }}</p> @endif
                    <p><b>Latitude:</b> {{ $place->latitude }}</p>
                    <p><b>Longitude:</b> {{ $place->longitude }}</p>
                    @if ($place->website) <p><b>Website:</b> {{ $place->website }}</p> @endif
                    <p><b>Confirmações de usuários:</b> {{ $confirmations }}</p>
                    @foreach ($place->place_type as $place_type)
                    <p><b>Categoria:</b> {{ $place_type->category }}</p>
                    <p><b>Tipo:</b> {{ $place_type->type }}</p>
                    @endforeach
                    <p>
                        <b>Você confirma as informações desse lugar?</b>
                        <a href="{{ url('/place/confirm?place='.$place->id."&exists=1") }}"><button class="btn btn-success">Sim</button></a>
                        <a href="{{ url('/place/confirm?place='.$place->id."&exists=0") }}"><button class="btn btn-danger">Não</button></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <a href="{{ url('/places') }}"><button class="btn btn-primary">Voltar</button></a>
        </div>
    </div>
@endsection