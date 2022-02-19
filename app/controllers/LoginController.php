<?php

namespace App\Controllers;

use App\Models\User;

class LoginController
{
    public function index()
    {
        $users = User::all();
        include_once "./app/admin/tai-khoan/index.php";
    }

    public function login()
    {
        include_once "./app/views/tai-khoan/login.php";
    }
    public function addAccount()
    {
        include_once "./app/views/tai-khoan/dang-ki.php";
    }
    public function saveAccount()
    {
        $model = new User();
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        $model->insert($data);
        header('location: ' . BASE_URL . 'tai-khoan/dang-nhap');
        die;
    }
    public function saveEditAccount($id)
    {
        $model = User::where('id', '=', $id)->first();
        if (!$model) {
            header('location: ' . BASE_URL . 'dashboard/tai-khoan');
            die;
        }

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'avatar' => $_POST['avatar']
        ];
        $model->update($data);
        header('location: ' . BASE_URL . 'dashboard/tai-khoan');
        die;
    }
    public function saveEditAccountView($id)
    {
        $model = User::where('id', '=', $id)->first();
        if (!$model) {
            header('location: ' . BASE_URL . 'mon-hoc');
            die;
        }

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'avatar' => $_POST['avatar']
        ];
        $model->update($data);
        header('location: ' . BASE_URL . 'mon-hoc');
        die;
    }
    public function removeAccount($id)
    {
        User::destroy($id);
        header('location: ' . BASE_URL . 'dashboard/tai-khoan');
        die;
    }
    public function editAccount($id)
    {
        $model = User::where('id', '=', $id)->first();
        if (!$model) {
            header('location: ' . BASE_URL . 'dashboard/tai-khoan');
            die;
        }
        include_once './app/admin/tai-khoan/edit-account.php';
    }
    public function editAccountView($id)
    {
        $model = User::where('id', '=', $id)->first();
        if (!$model) {
            header('location: ' . BASE_URL . 'mon-hoc');
            die;
        }
        include_once './app/views/tai-khoan/edit-account.php';
    }
    public function checkLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::where('email', $email)->first();
        if ($user && ($password == $user->password)) {
            $_SESSION['auth'] = [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "role_id" => $user->role_id
            ];
            header('location: ' . BASE_URL . 'mon-hoc');
            die();
        }
        header('Location: ' . BASE_URL . 'tai-khoan/dang-nhap');
        die();
    }
    public function exit()
    {
        session_unset();
        header('location: ' . BASE_URL . 'tai-khoan/dang-nhap');
        die;
    }
}
