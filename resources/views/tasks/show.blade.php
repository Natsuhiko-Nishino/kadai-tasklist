@extends('layouts.app')

@section('content')

    <h1>Detail of id = {{ $tasks->id }}</h1>
    
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $tasks->id }}</td>
        </tr>
        <tr>
            <th>Task</th>
            <td>{{ $tasks->content }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $tasks->status }}</td>
        </tr>
    </table>

    <p>tasks : {{ $tasks->content }}</p>
    <p>status : {{ $tasks->status }}</p>

{!! link_to_route('tasks.edit', 'edit this task', ['id' => $tasks->id], ['class' => 'btn btn-default']) !!}

 {!! Form::model($tasks, ['route' => ['tasks.destroy', $tasks->id], 'method' => 'delete']) !!}
        {!! Form::submit('delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection

