<!-- resources/views/questions/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Question</h1>

    <form method="post" action="{{ route('quizzes.questions.update', ['quiz' => $quiz, 'question' => $question]) }}">
        @csrf
        @method('PUT')

        <label for="question">Question:</label>
        <input type="text" id="question" name="question" value="{{ $question->question }}" required>
        <br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required>{{ $question->description }}</textarea>
        <br>

        <label for="answer_1">Answer 1:</label>
        <input type="text" id="answer_1" name="answer_1" value="{{ $question->answer_1 }}" required>
        <br>

        <label for="answer_2">Answer 2:</label>
        <input type="text" id="answer_2" name="answer_2" value="{{ $question->answer_2 }}" required>
        <br>

        <label for="answer_3">Answer 3:</label>
        <input type="text" id="answer_3" name="answer_3" value="{{ $question->answer_3 }}" required>
        <br>

        <label for="answer_4">Answer 4:</label>
        <input type="text" id="answer_4" name="answer_4" value="{{ $question->answer_4 }}" required>
        <br>

        <label for="correct_answer">Correct Answer:</label>
        <select id="correct_answer" name="correct_answer" required>
            <option value="answer_1" {{ $question->correct_answer === 'answer_1' ? 'selected' : '' }}>Answer 1</option>
            <option value="answer_2" {{ $question->correct_answer === 'answer_2' ? 'selected' : '' }}>Answer 2</option>
            <option value="answer_3" {{ $question->correct_answer === 'answer_3' ? 'selected' : '' }}>Answer 3</option>
            <option value="answer_4" {{ $question->correct_answer === 'answer_4' ? 'selected' : '' }}>Answer 4</option>
        </select>
        <br>

        <!-- Add other fields as needed -->

        <button type="submit">Update Question</button>
    </form>
@endsection
