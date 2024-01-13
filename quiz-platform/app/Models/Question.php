<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id', 'question', 'description', 'photo', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'correct_answer', 'position'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
