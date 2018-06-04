@extends('layouts.app')

@section('content')

    <h1>Detail of id = {{ $tasks->id }}</h1>

    <p>tasks : {{ $tasks->content }}</p>
    <p>status : {{ $tasks->status }}</p>

{!! link_to_route('tasks.edit', 'edit this task', ['id' => $tasks->id]) !!}

 {!! Form::model($tasks, ['route' => ['tasks.destroy', $tasks->id], 'method' => 'delete']) !!}
        {!! Form::submit('delete') !!}
    {!! Form::close() !!}
@endsection