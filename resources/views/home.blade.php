@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <!-- Display Messages -->
            @include('common.messages')

            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="{{ url('/place') }}">
                        <button class="btn btn-lg btn-primary">Cadastrar novo PoI</button>
                    </a>
                    <a href="{{ url('/places') }}">
                        <button class="btn btn-lg btn-primary">Gerenciar PoIs</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
