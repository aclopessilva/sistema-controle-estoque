@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($show_admin_dashboard == true)
                        Valor total de items com estoque:  {{$custo_total}}
                    @else
                        Você nao tem dashboard
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
