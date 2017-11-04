@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Showing {{ $user->name }}</div>

                <div class="panel-body">
                    
                    <div class="jumbotron text-center">
                        <h2>{{ $user->name }}</h2>
                        <p>
                            <strong>Email:</strong> {{ $user->email }}<br>
                            <strong>isAdmin:</strong> {{ $user->isAdmin }}<br>
                            <strong>isActive:</strong> {{ $user->isActive }}<br>
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
