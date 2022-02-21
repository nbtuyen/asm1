<?php

namespace App\Controllers;

use App\Models\Subject;

use App\Models\Quiz;

use App\Models\Question;

class SubjectController
{
    public function index($id = null)
    {
        if (empty($id)) {
            $subjects = Subject::all();
            return view(
                'mon-hoc.index',
                [
                    'subjects' => $subjects
                ],
            );
        } else {
            $subject = Subject::where('id', '=', $id)->first();
            $quizs = Quiz::where('subject_id', '=', $id)->get();
            return view(
                'mon-hoc.index',
                [
                    'subjects' => $subject,
                    'quizs ' => $quizs
                ],
            );
        }
    }
    public function dashoardSubject($id = null)
    {
        if (empty($id)) {
            $subjects = Subject::all();
            return admin(
                'mon-hoc.index',
                ['subjects' => $subjects]
            );
        } else {
            $subject = Subject::where('id', '=', $id)->first();
            $quizs = Quiz::where('subject_id', '=', $id)->get();
            return admin(
                'mon-hoc.index',
                [
                    'subjects' => $subject,
                    'quizs ' => $quizs
                ],
            );
        }
    }

    public function addForm()
    {
        return admin(
            'mon-hoc.add-form',
            [],
        );
    }
    public function editForm($id)
    {
        $model = Subject::where('id', '=', $id)->first();
        if (!$model) {
            header('location: ' . BASE_URL . 'dashboard/mon-hoc');
            die;
        }
        return admin(
            'mon-hoc.edit-form',
            [
                'model' => $model,
            ],
        );
    }

    public function saveAdd()
    {
        $model = new Subject();
        $data = [
            'name' => $_POST['name']
        ];
        $model->insert($data);
        header('location: ' . BASE_URL . 'dashboard/mon-hoc');
        die;
    }

    public function saveEdit($id)
    {
        $model = Subject::find($id);

        if (!$model) {
            header('location: ' . BASE_URL . 'dashboard/mon-hoc');
            die;
        }
        $model->name = $_POST['name'];
        $model->save();
        header('location: ' . BASE_URL . 'dashboard/mon-hoc');
        die;
    }

    public function remove($id)
    {
        Subject::destroy($id);
        header('location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }
}
