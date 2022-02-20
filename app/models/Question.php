<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    public $timestamps = false;
    public function quiz()
    {
        $quiz = Quiz::where('id', '=', $this->quiz_id)->first();
        if ($quiz) {
            return $quiz;
        }
        return null;
    }
    public function getAnswers()
    {
        return Answer::where('question_id', '=', $this->id)->get();
    }
}
