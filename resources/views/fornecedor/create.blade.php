@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Criando fornecedor</div>

                <div class="panel-body">
                    
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}

                    {{ Form::open(array('url' => 'fornecedor')) }}

                        <div class="form-group">
                            {{ Form::label('nome', 'Nome') }}
                            {{ Form::text('nome', Input::old('nome'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('endereco', 'endereco') }}
                            {{ Form::text('endereco', Input::old('endereco'), array('class' => 'form-control')) }}
                        </div>
                     
                        <div class="form-group">
                            {{ Form::label('cnpj', 'cnpj') }}
                            {{ Form::text('cnpj', Input::old('cnpj'), array('class' => 'form-control')) }}
                        </div>

                        {{ Form::submit('Enviar!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
