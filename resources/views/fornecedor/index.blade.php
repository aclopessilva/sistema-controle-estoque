@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Fornecedor</div>

                <div class="panel-body">
                    <a class="btn btn-small btn-success" href="{{ URL::to('fornecedor/create') }}">Criar fornecedor</a>
                    <br> <br>
                    
                    <!-- will be used to show any messages -->
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Nome</td>
                                <td>Endereco</td>
                                <td>CNPJ</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($fornecedors as $key => $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->nome }}</td>
                                <td>{{ $value->endereco }}</td>
                                <td>{{ $value->cnpj }}</td>

                                <!-- we will also add show, edit, and delete buttons -->
                                <td>

                                    <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                    {{ Form::open(array('url' => 'fornecedor/' . $value->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                                    {{ Form::close() }}
                                    
                                    <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                    <a class="btn btn-small btn-success" href="{{ URL::to('fornecedor/' . $value->id) }}">Ver</a>

                                    <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                    <a class="btn btn-small btn-info" href="{{ URL::to('fornecedor/' . $value->id . '/edit') }}">Editar</a>

                                </td>
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
