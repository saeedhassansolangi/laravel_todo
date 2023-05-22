@extends('layouts.html_temp')

@section('title')
    Create Todo
@endsection

@section('content')
    <h1>Create Todo</h1>
    <form action="/todos" method="post">
        @csrf
        <input type="text" name="title" id="title" placeholder="title">
        @error('title')
            <pre class="error">{{ $message }}</pre>
        @enderror
        <input type="text" name="description" id="description" placeholder="description">
        @error('description')
            <pre class="error">{{ $message }}</pre>
        @enderror
        <input type="submit" value="Submit">
    </form>
@endsection
