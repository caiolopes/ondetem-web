@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="{{ url('/place/add') }}">
                        <button class="btn btn-lg btn-primary">Cadastrar novo local</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
