@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Produtos com estoque</div>

                <div class="panel-body">
                    
                    <!-- will be used to show any messages -->
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Nome</td>
                                <td>Descrição</td>
                                <td>Custo</td>
                                <td>Quantidade</td>
                                <td>Fornecedor</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $key => $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->nome }}</td>
                                <td>{{ $value->descricao }}</td>
                                <td>{{ $value->custo }}</td>
                                <td>{{ $value->quantidade }}</td>
                                <td>{{ $value->fornecedor()->withTrashed()->first()->nome }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
