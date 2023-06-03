@extends('layouts.html_temp')


@section('title')
    Todo
@endsection

@section('content')
    <h1>Todos</h1>

    <a class="btn btn-primary" href="/todo-form">Add new Todo</a>

    @forelse ($todos as $todo)
        <div @class([
            'todos',
            'todo-complete' => !!$todo->is_task_complete,
            'todo-uncomplete' => !$todo->is_task_complete,
        ])>
            <div class="text">
                <h3>{{ $todo->task_title }}</h3>
                <p>{{ $todo->task_description }}</p>
            </div>

            <div class="btn_container">
                <p class="btn edit"><a href="/todos/{{ $todo->id }}">Edit Todo</a></p>
                <p class="btn delete"><a href="/todos/delete/{{ $todo->id }}">Delete Todo</a></p>
            </div>
        </div>
    @empty
        <p><a href="/todo-form">No todo found, lets create one</a></p>
    @endforelse
@endsection
