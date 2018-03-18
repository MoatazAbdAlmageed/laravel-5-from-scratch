@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Create a new task</h3>
        </div>
        <div class="panel-body">
                {!! Form::open(array('route' => 'tasks.store','method'=>'POST')) !!}
                @include('tasks.form')
                {!! Form::close() !!}

        </div>
    </div>




@endsection


