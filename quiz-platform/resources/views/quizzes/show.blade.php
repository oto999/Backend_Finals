@extends('layouts.app')

@section('content')
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>

    <form id="quiz-form" data-quiz-id="{{ $quiz->id }}">
        @csrf
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
        @forelse ($quiz->questions as $question)
            <div class="question-container" data-question-id="{{ $question->id }}">
                <h3>{{ $question->question }}</h3>
                <p>{{ $question->description }}</p>

                <label for="selected_option_{{ $question->id }}">Select an option:</label>
                <select name="selected_options[{{ $question->id }}]" required>
                    <option value="answer_1">{{ $question->answer_1 }}</option>
                    <option value="answer_2">{{ $question->answer_2 }}</option>
                    <option value="answer_3">{{ $question->answer_3 }}</option>
                    <option value="answer_4">{{ $question->answer_4 }}</option>
                </select>

                <div class="answer-result" data-question-id="{{ $question->id }}"></div>

                <!-- Add an "Edit" link for each question -->
                <a href="{{ route('quizzes.questions.edit', ['quiz' => $quiz, 'question' => $question]) }}">Edit</a>
            </div>
        @empty
            <p>No questions available for this quiz.</p>
        @endforelse

        <button type="submit">Submit Quiz</button>
        <div id="correctness-label"></div>
    </form>

    <a href="{{ route('quizzes.questions.create', $quiz) }}">Add Question</a>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quizForm = document.getElementById('quiz-form');

            if (quizForm) {
                quizForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const quizId = extractQuizIdFromUrl();

                    fetch(`/quizzes/${quizId}/submit-quiz`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        handleQuizSubmission(data);
                    })
                    .catch(error => console.error('Error:', error));
                });
            }

            function extractQuizIdFromUrl() {
                const urlParts = window.location.href.split('/');
                const quizIdIndex = urlParts.indexOf('quizzes') + 1;

                return quizIdIndex > 0 && quizIdIndex < urlParts.length ? urlParts[quizIdIndex] : null;
            }

            function handleQuizSubmission(data) {
                document.querySelectorAll('.question-container').forEach(questionContainer => {
                    const questionId = questionContainer.getAttribute('data-question-id');
                    const answerResult = questionContainer.querySelector('.answer-result');

                    if (data[questionId]) {
                        answerResult.innerHTML = '<span style="color: green;">Right</span>';
                    } else {
                        answerResult.innerHTML = '<span style="color: red;">Wrong</span>';
                    }
                });

                // Calculate correctness and update the label
                const correctnessLabel = document.getElementById('correctness-label');
                const correctCount = Object.values(data).filter(value => value).length;
                const totalQuestions = Object.values(data).length;
                const correctnessPercentage = (correctCount / totalQuestions) * 100;

                correctnessLabel.innerHTML = `Correctness: ${correctCount}/${totalQuestions} - ${correctnessPercentage.toFixed(2)}%`;
            }
        });
    </script>
@endsection
