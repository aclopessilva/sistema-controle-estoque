@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $produto->name }}</div>

                <div class="panel-body">
                    
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}

                    {{ Form::model($produto, array('route' => array('produto.update', $produto->id), 'method' => 'PUT')) }}

                        <div class="form-group">
                            {{ Form::label('nome', 'Name') }}
                            {{ Form::text('nome', null, array('class' => 'form-control')) }}
                        </div>
                    
                        <div class="form-group">
                            {{ Form::label('descricao', 'Descrição') }}
                            {{ Form::text('descricao', null, array('class' => 'form-control')) }}
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('custo', 'Custo') }}
                            {{ Form::text('custo', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('quantidade', 'Quantidade') }}
                            {{ Form::text('quantidade', null, array('class' => 'form-control')) }}
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
