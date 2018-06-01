@extends('layouts.app')

@section('content')

    <h1>Posting new task</h1>

    {!! Form::model($tasks, ['route' => 'tasks.store']) !!}

        {!! Form::label('content', 'task:') !!}
        {!! Form::text('content') !!}

        {!! Form::submit('post') !!}

    {!! Form::close() !!}

@endsection