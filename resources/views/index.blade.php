

@extends('layouts.app')

@section('title','List of tasks')


@section('content')







<div>
<!-- @if(count($tasks)) -->
@forelse($tasks as $task)
 <div>
    <a href="{{route('tasks.show',['task'=> $task->id])}}">{{$task->title}}</a>
</div>

@empty
 <div>There are no tasks!</div>
@endforelse 
<!-- @endif -->

</div>


@endsection('content')