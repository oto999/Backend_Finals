<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question' => 'required',
            'answer_1' => 'required',
            'answer_2' => 'required',
            'answer_3' => 'required',
            'answer_4' => 'required',
            'correct_answer' => 'required|in:answer_1,answer_2,answer_3,answer_4',
            'position' => 'required|integer',
        ]);

        $question = new Question($request->all());
        $question->quiz_id = $quiz->id;
        $question->save();

        return redirect("/quizzes/{$quiz->id}")->with('success', 'Question added successfully!');
    }

    public function check(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'selected_option' => 'required|exists:options,id,question_id,' . $question->id,
        ]);

        $selectedOption = $question->options()->findOrFail($request->input('selected_option'));

        return view('quizzes.check', compact('quiz', 'question', 'selectedOption'));
    }

    public function answer(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'selected_option' => 'required|exists:options,id,question_id,' . $question->id,
        ]);

        $selectedOption = Option::findOrFail($request->input('selected_option'));

        $isCorrect = $selectedOption->is_correct;

        return response()->json([
            'selectedOption' => $selectedOption,
            'isCorrect' => $isCorrect,
        ]);
    }

    public function edit(Quiz $quiz, Question $question)
    {
        return view('questions.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'question' => 'required',
            'description' => 'required',
            'answer_1' => 'required',
            'answer_2' => 'required',
            'answer_3' => 'required',
            'answer_4' => 'required',
            'correct_answer' => 'required',
            // Add other validation rules as needed
        ]);
    
        $question->update($request->all());
    
        return redirect()->route('quizzes.show', $quiz)->with('success', 'Question updated successfully!');
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        $question->delete();

        return redirect("/quizzes/{$quiz->id}")->with('success', 'Question deleted successfully!');
    }
}
