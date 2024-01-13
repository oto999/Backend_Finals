<!-- resources/views/quizzes/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Quizzes</h1>

    @forelse ($quizzes as $quiz)
        <div class="quiz-container">
            <h2>{{ $quiz->title }}</h2>
            <p>{{ $quiz->description }}</p>

            <!-- Display the number of questions for each quiz -->
            <p>Questions: {{ $quiz->questions->count() }}</p>

            <a href="{{ route('quizzes.show', $quiz) }}">Start Quiz</a>
        </div>
    @empty
        <p>No quizzes available.</p>
    @endforelse
@endsection
