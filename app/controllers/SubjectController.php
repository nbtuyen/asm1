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
            include_once "./app/views/mon-hoc/index.php";
        } else {
            $subject = Subject::where('id', '=', $id)->first();
            $quizs = Quiz::where('subject_id', '=', $id)->get();
            include_once "./app/views/mon-hoc/index.php";
        }
    }
    public function dashoardSubject($id = null)
    {
        if (empty($id)) {
            $subjects = Subject::all();
            include_once "./app/admin/mon-hoc/index.php";
        } else {
            $subject = Subject::where('id', '=', $id)->first();
            $quizs = Quiz::where('subject_id', '=', $id)->get();
            include_once "./app/admin/mon-hoc/index.php";
        }
    }
    public function subject_id()
    {
        $subjects = Subject::all();
        include_once "./app/admin/mon-hoc/edit-form.php";
    }

    public function addForm()
    {
        include_once "./app/admin/mon-hoc/add-form.php";
    }
    public function editForm($id)
    {
        $model = Subject::where('id', '=', $id)->first();
        if (!$model) {
            header('location: ' . BASE_URL . 'dashboard/mon-hoc');
            die;
        }
        include_once './app/admin/mon-hoc/edit-form.php';
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
