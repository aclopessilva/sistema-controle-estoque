@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Showing {{ $fornecedor->nome }}</div>

                <div class="panel-body">
                    
                    <div class="jumbotron text-center">
                        <h2>{{ $fornecedor->nome }}</h2>
                        <p>
                            <strong>endereco:</strong> {{ $fornecedor->endereco }}<br>
                            <strong>CNPJ:</strong> {{ $fornecedor->cnpj }}<br>
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
