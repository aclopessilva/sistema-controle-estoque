@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User</div>

                <div class="panel-body">
                    <a class="btn btn-small btn-success" href="{{ URL::to('user/create') }}">Criar usuario</a>
                    <br> <br>
                    
                    <!-- will be used to show any messages -->
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Is Admin</td>
                                <td>Is Active</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $key => $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->isAdmin }}</td>
                                <td>{{ $value->isActive }}</td>

                                <!-- we will also add show, edit, and delete buttons -->
                                <td>

                                    <!-- metodo para deletar usuario  usando metodo HTTP DELETE que esta apontando para  metodo DESTROY do controller /user/{id} -->
                                    {{ Form::open(array('url' => 'user/' . $value->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                                    {{ Form::close() }}

                                    <!-- metodo para bloquead /user/block/{id} -->
                                    {{ Form::open(array('url' => 'user/block/' . $value->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'GET') }}
                                        {{ Form::submit('Bloquear', array('class' => 'btn btn-info')) }}
                                    {{ Form::close() }}
                                    
                                    <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                    <a class="btn btn-small btn-success" href="{{ URL::to('user/' . $value->id) }}">Ver</a>

                                    <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                    <a class="btn btn-small btn-info" href="{{ URL::to('user/' . $value->id . '/edit') }}">Editar</a>

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
