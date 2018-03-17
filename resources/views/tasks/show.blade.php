@extends('layouts.app')

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif


    <form method="post" action="{{url('/tasks')}}">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="title">Task body:</label>
            <input type="text" class="form-control" value="{{$task->body}}" name="body"/>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>




@endsection


