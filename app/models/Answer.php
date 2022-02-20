<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    public $timestamps = false;
    public function question()
    {
        $question = Question::where('id', '=', $this->question_id)->first();
        if ($question) {
            return $question;
        }
        return null;
    }
}
