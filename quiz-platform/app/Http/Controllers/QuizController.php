<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::orderBy('created_at', 'desc')->get();
        return view('quizzes.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions'); // Ensure the questions relationship is loaded
    
        return view('quizzes.show', compact('quiz'));
    }

    public function create()
    {
        // Load all quizzes sorted by the time they were added
        $quizzes = Quiz::orderBy('created_at', 'desc')->get();
    
        return view('quizzes.create', compact('quizzes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
    
        // Create the quiz with author_id set to 0
        $quiz = new Quiz([
            'title' => $request->title,
            'description' => $request->description,
            'author_id' => 0,
        ]);
    
        $quiz->save();
    
        // Redirect to the show page of the newly created quiz
        return redirect()->route('quizzes.show', ['quiz' => $quiz->id])->with('success', 'Quiz created successfully');
    }
    
    
    public function edit(Quiz $quiz, Question $question)
    {
        return view('questions.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $quiz->update($request->all());

        return redirect("/quizzes/{$quiz->id}")->with('success', 'Quiz updated successfully!');
    }

    public function submitQuiz(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $userAnswers = $request->get('selected_options');
    
        $results = [];
        
        foreach ($quiz->questions as $question) {
            $correctAnswer = $question->correct_answer;
            $userAnswer = $userAnswers[$question->id];
    
            $results[$question->id] = $correctAnswer === $userAnswer;
        }
    
        return response()->json($results);
    }

    // Check if the selected option is correct for a given question
    private function isOptionCorrect($question, $selectedOptionId)
    {
        $correctOption = $question->options->where('is_correct', true)->first();

        return $correctOption && $correctOption->id == $selectedOptionId;
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect('/')->with('success', 'Quiz deleted successfully!');
    }
}
