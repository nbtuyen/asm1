<?php

namespace App\Controllers;

use App\Models\Question;

use App\Models\Quiz;

use App\Models\Answer;

class QuestionController
{
    public function editQuest()
    {
        $id = $_GET['id'];
        $model = Question::where(['id', '=', $id])->first();
        $quizs = Quiz::all();
        if (!$model) {
            header('location: ' . BASE_URL . 'question');
            die;
        }
        return admin(
            'question.edit-form',
            [
                'model' => $model,
                'quizs ' => $quizs
            ],
        );
    }
    public function questDetail($id)
    {
        $quest = Question::where('quiz_id', '=', $id)->get();
        if (!$quest) {
            header('location: ' . BASE_URL . 'quiz/chi-tiet/' . $id);
            die;
        }
        return view(
            'quiz.quizDetail',
            [
                'quest' => $quest
            ],
        );
    }

    public function saveQuest()
    {

        $question = new Question();
        $data = [
            'name' => $_POST['name'],
            'quiz_id' => $_GET['quizId']
        ];

        $question->insert($data);
        header('location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }

    public function saveEditQuest()
    {
        $id = $_GET['id'];
        $model = Question::where(['id', '=', $id])->first();
        if (!$model) {
            header('location: ' . BASE_URL . 'dashboard/question');
            die;
        }

        $data = [
            'name' => $_POST['name'],
            'quiz_id' => $_POST['quiz_id']
        ];
        $model->update($data);
        header('location: ' . BASE_URL . 'dashboard/question');
        die;
    }

    public function remove($id)
    {
        Question::destroy($id);
        header('location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }
}
