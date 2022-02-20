<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizs';
    public $timestamps = false;
    public function subject()
    {
        $subject = Subject::where('id', '=', $this->subject_id)->first();
        if ($subject) {
            return $subject;
        }
        return null;
    }
}
