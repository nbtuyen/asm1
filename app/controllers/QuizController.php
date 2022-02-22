<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Question;

class QuizController
{
    public function index()
    {
        $quizs = Quiz::all();
        return view(
            'quiz.index',
            [
                'quizs' => $quizs
            ],
        );
    }
    public function dashboardQuiz($id)
    {
        $subject = Subject::where('id', '=', $id)->first();
        if (empty($subject)) {
            header("location: " . BASE_URL);
            die;
        }

        // 2. lấy danh sách quiz của môn học đó ra
        $subjectQuizs = Quiz::where('subject_id', '=', $subject->id)->get();

        return admin(
            'quiz.index',
            [
                'subject' => $subject,
                'subjectQuizs' => $subjectQuizs
            ]
        );
    }
    public function addQuiz($id)
    {
        return admin(
            'quiz.add-quiz',
            []
        );
    }
    public function editQuiz($id)
    {
        $quiz = Quiz::where('id', '=', $id)->first();
        $questions = Question::where('quiz_id', '=', $quiz->id)->get();
        return admin(
            'quiz.edit-quiz',
            [
                'questions' => $questions,
                'quiz' => $quiz
            ]
        );
    }
    public function subjectDetail($id)
    {
        $model = Quiz::where('subject_id', '=', $id)->get();
        if (!$model) {
            header('location: ' . BASE_URL . 'mon-hoc');
            die;
        }
        return view(
            'quiz.subjectDetail',
            [
                'model' => $model,
            ],
        );
    }



    public function saveQuiz($id)
    {
        $data = [
            'name' => $_POST['name'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
            'duration_minutes' => $_POST['duration_minutes'],
            'status' => isset($_POST['status']) ? 1 : 0,
            'is_shuffle' => isset($_POST['is_shuffle']) ? 1 : 0,
            'subject_id' => $id
        ];
        $model = new Quiz();
        $model->insert($data);
        header('location: ' . BASE_URL . 'dashboarh/quiz/ ' . $id);
        die;
    }

    public function saveEditQuiz($id)
    {
        $model = Quiz::find($id);
        if (!$model) {
            header('location: ' . BASE_URL . 'dashboard/mon-hoc');
            die;
        }


        $model->name = $_POST['name'];
        $model->name = $_POST['name'];
        $model->start_time = $_POST['start_time'];
        $model->end_time = $_POST['end_time'];
        $model->duration_minutes = $_POST['duration_minutes '];
        $model->status = isset($_POST['status ']) ? 1 : 0;
        $model->is_shuffle = isset($_POST['is_shuffle']) ? 1 : 0;

        $model->save();
        header('location: ' . BASE_URL . 'quiz/cap-nhat/' . $id);
        die;
    }

    public function remove($id)
    {
        Quiz::destroy($id);
        header('location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }
}
