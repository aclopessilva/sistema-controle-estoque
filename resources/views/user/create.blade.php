@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Criando usuario</div>

                <div class="panel-body">
                    
                    <!-- if there are creation errors, they will show here -->
                    {{ HTML::ul($errors->all()) }}

                    {{ Form::open(array('url' => 'user')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('nerd_level', 'Admin') }}
                            {{ Form::select('nerd_level', array( false => 'Não', true => 'Sim'), Input::old('nerd_level'), array('class' => 'form-control')) }}
                        </div>

                        {{ Form::submit('Enviar!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
