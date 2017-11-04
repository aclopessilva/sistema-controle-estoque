@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $user->name }}</div>

                <div class="panel-body">
                    
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}

                    {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', null, array('class' => 'form-control')) }}
                        </div>

                        
                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}                            
                            {{ Form::password('password', array('class' => 'form-control')) }}
                        </div>
                    
                        <div class="form-group">
                            {{ Form::label('isAdmin', 'Admin') }}
                            {{ Form::select('isAdmin', array( false => 'Não', true => 'Sim'), Input::old('isAdmin'), array('class' => 'form-control')) }}
                        </div>
                    
                        <div class="form-group">
                            {{ Form::label('isActive', 'Ativo') }}
                            {{ Form::select('isActive', array( true => 'Sim', false => 'Não'), Input::old('isActive'), array('class' => 'form-control')) }}
                        </div>

                        {{ Form::submit('Enviar!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
