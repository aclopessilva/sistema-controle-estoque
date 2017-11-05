@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Criando Produto</div>

                <div class="panel-body">
                    
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}

                    {{ Form::open(array('url' => 'produto')) }}
                    
                        <div class="form-group">
                            {{ Form::label('nome', 'Name') }}
                            {{ Form::text('nome', Input::old('nome'), array('class' => 'form-control')) }}
                        </div>
                    
                        <div class="form-group">
                            {{ Form::label('descricao', 'Descrição') }}
                            {{ Form::text('descricao', Input::old('descricao'), array('class' => 'form-control')) }}
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('custo', 'Custo') }}
                            {{ Form::text('custo', Input::old('custo'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('quantidade', 'Quantidade') }}
                            {{ Form::text('quantidade', Input::old('quantidade'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('fornecedor_id', 'Fornecedor') }}
                            {!! Form::select('fornecedor_id', $fornecedores, Input::old('fornecedor_id'), ['class'=> 'form-control'])  !!}
                        </div>

                    
                        {{ Form::submit('Enviar!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
