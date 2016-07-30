@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('/places/search') }}" method="GET" class="form-inline">
                    <label for="search">Buscar:</label>
                    <input id="search" class="form-control" type="text" name="key" value="{{ isset($query) ? $query : '' }}"/>
                    <input type="submit" class="btn btn-primary" value="Buscar">
                </form>
                <br>
                <form action="{{ url('/places/search') }}" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="category">Categoria:</label>
                        <select id="category" name="category" class="form-control"></select>
                    </div>

                    <div class="form-group">
                        <label for="type">Tipo:</label>
                        <select id="type" name="type" class="form-control"></select>
                        <input class="btn btn-primary" type="submit" value="Filtrar">
                    </div>
                </form>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="list-group">
                    @foreach ($places as $place)
                        <a class="list-group-item" href="{{ url('/place/'.$place->id) }}">
                            <h4 class="list-group-item-heading">{{ $place->name }}</h4>
                            <p class="list-group-item-text">{{ $place->address }}</p>
                        </a>
                    @endforeach
                </div>
                {{ $places->links() }}
            </div>
        </div>
    </div>
@endsection