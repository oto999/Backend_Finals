@extends('layouts.app')

@section('content')
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>

    <h2>{{ $question->question }}</h2>
    <p>Your selected option: {{ $selectedOption->answer }}</p>
    <p>{{ $selectedOption->is_correct ? 'Correct' : 'Wrong' }}</p>

    <a href="{{ route('quizzes.questions.create', $quiz) }}">Add Question</a>
@endsection
