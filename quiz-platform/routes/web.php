<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;

Route::get('/', [QuizController::class, 'index']);
Route::get('/quizzes/create', [QuizController::class, 'create']);
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('quizzes.questions.create');
Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('quizzes.questions.store');
Route::post('/quizzes/{quiz}/questions/{question}/answer', [QuestionController::class, 'answer'])->name('quizzes.questions.answer');
Route::post('/quizzes/{quizId}/submit-quiz', [QuizController::class, 'submitQuiz']);
Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
Route::get('/quizzes/{quiz}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('quizzes.questions.edit');
Route::resource('quizzes.questions', QuestionController::class)->except(['index', 'show']);
Route::put('/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'update'])->name('quizzes.questions.update');
