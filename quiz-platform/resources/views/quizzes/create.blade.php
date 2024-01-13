@extends('layouts.app')

@section('content')
    <h1>Create Quiz</h1>

    <!-- Display existing quizzes -->
    <h2>Existing Quizzes</h2>
    <ul>
        @foreach($quizzes as $existingQuiz)
            <li>{{ $existingQuiz->title }} - {{ $existingQuiz->created_at }}</li>
        @endforeach
    </ul>

    <!-- Create Quiz Form -->
    <form id="createQuizForm" action="{{ route('quizzes.store') }}" method="post">
    @csrf
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>
    <br>
    <button type="submit">Create Quiz</button>
</form>


    <script>
        function submitForm() {
            const title = document.getElementById('title').value;
            const description = document.getElementById('description').value;

            fetch('/quizzes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    title: title,
                    description: description,
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Optionally, you can handle the response data here
                console.log(data);
                // Redirect to the main page
                window.location.href = '{{ url('/') }}';
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
