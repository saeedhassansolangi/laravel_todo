@extends('layouts.html_temp')


@section('title')
    Update Todo
@endsection


@section('content')
    <h1>Update Todo </h1>
    <form action="/todos/edit/" method="post">
        @csrf
        <input type="text" hidden name="todo_id" id="todo_id" value="{{ $todo->id }}">

        <input type="text" name="title" id="title" value="{{ $todo->task_title }}">
        @error('title')
            <pre>{{ $message }}</pre>
        @enderror
        <input type="text" name="description" id="description" value="{{ $todo->task_description }}">
        @error('description')
            <pre>{{ $message }}</pre>
        @enderror

        <div class="tag active">
            <label>Active:</label>
            <input type="radio" name="status" value="{{ 0 }}"
                {{ $todo->is_task_complete == 0 ? 'checked' : '' }}>
        </div>

        <div class="tag completed">
            <label>Completed:</label>
            <input type="radio" name="status" value="{{ 1 }}"
                {{ $todo->is_task_complete == 1 ? 'checked' : '' }}>
        </div>

        <input type="submit" value="Submit">
    </form>
@endsection
