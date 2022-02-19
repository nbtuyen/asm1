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
        include_once './app/admin/question/edit-form.php';
    }
    public function QuestDetail()
    {
        $id = $_GET['id'];
        $quest = Question::where(['quiz_id', '=', $id])->get();
        if (!$quest) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
        include_once './app/views/quiz/quizDetail.php';
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
