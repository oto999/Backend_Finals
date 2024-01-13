@extends('layouts.app')

@section('content')
    <h1>Edit Quiz</h1>

    <form method="post" action="{{ url("/quizzes/{$quiz->id}") }}">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ $quiz->title }}" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" required>{{ $quiz->description }}</textarea>
        <br>
        <button type="submit">Update Quiz</button>
    </form>
@endsection
