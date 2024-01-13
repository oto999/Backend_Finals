@extends('layouts.app')

@section('content')
    <h1>Create Question for {{ $quiz->title }}</h1>

    <form method="post" action="{{ route('quizzes.questions.store', $quiz) }}">
        @csrf
        <label for="question">Question:</label>
        <input type="text" name="question" required>
        <label for="answer_1">Answer 1:</label>
        <input type="text" name="answer_1" required>
        <label for="answer_2">Answer 2:</label>
        <input type="text" name="answer_2" required>
        <label for="answer_3">Answer 3:</label>
        <input type="text" name="answer_3" required>
        <label for="answer_4">Answer 4:</label>
        <input type="text" name="answer_4" required>
        <label for="correct_answer">Correct Answer:</label>
        <select name="correct_answer" required>
            <option value="answer_1">Answer 1</option>
            <option value="answer_2">Answer 2</option>
            <option value="answer_3">Answer 3</option>
            <option value="answer_4">Answer 4</option>
        </select>
        <label for="position">Position:</label>
        <input type="number" name="position" required>
        <button type="submit">Add Question</button>
    </form>
@endsection
