@extends('layouts.app')

@section('title', 'List of tasks')


@section('content')

    <div>
        <a href="{{ route('tasks.create') }}">Add</a>
    </div>


    @forelse($tasks as $task)
        <div>
            <a href="{{route('tasks.show', ['task' => $task->id])}}">{{$task->title}}</a>
        </div>

    @empty
        <div>There are no tasks!</div>
    @endforelse


    @if ($tasks->count())
        <nav> {{ $tasks->links() }}</nav>

    @endif



@endsection('content')