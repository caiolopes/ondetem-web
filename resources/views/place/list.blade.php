@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- Display Validation Errors -->
                @include('common.errors')
                <!-- Display Messages -->
                @include('common.messages')
                <h3>Buscar ou filtrar:</h3>

                <form action="{{ url('/places/search') }}" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="search">Buscar:</label>
                        <input id="search" class="form-control" type="text" name="key" value="{{ isset($query) ? $query : '' }}"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                    </div>
                </form>
                <br>
                <form action="{{ url('/places/search') }}" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="category">Categoria:</label>
                        <select id="category" name="category" class="category form-control"></select>
                    </div>

                    <div class="form-group">
                        <label for="type">Tipo:</label>
                        <select id="type" name="type" class="type form-control"></select>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Filtrar">
                    </div>
                </form>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 col-md-1">
                <a href={{ url('/places') }}><button class="btn btn-primary {{ empty(request()->input('active')) ? 'active' : '' }}">Todos</button></a>
            </div>
            <div class="col-xs-3 col-md-1">
                <a href={{ url('/places/search')."?active=true" }}>
                    <button class="btn btn-primary {{ request()->input('active') == 'true' ? 'active' : '' }}">Ativos</button>
                </a>
            </div>
            <div class="col-xs-3 col-md-1">
                <a href={{ url('/places/search')."?active=false" }}>
                    <button class="btn btn-primary {{ request()->input('active') == 'false'? 'active' : '' }}">Não ativos</button>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <h3>Lista:</h3>
                <div class="list-group">
                    @foreach ($places as $place)
                        <a class="list-group-item" href="{{ url('/place/'.$place->id) }}">
                            <h4 class="list-group-item-heading">{{ $place->name }} <i class="pull-right fa {{ $place->active ? 'fa-check' : 'fa-times' }}" aria-hidden="true"></i></h4>
                            <p class="list-group-item-text">{{ $place->address }}</p>
                        </a>
                    @endforeach
                </div>
                {{ $places->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection
