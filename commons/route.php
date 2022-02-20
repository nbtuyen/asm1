<?php

use App\Controllers\SubjectController;
use App\Controllers\LoginController;
use App\Controllers\QuizController;
use App\Controllers\QuestionController;
use App\Controllers\AnswerController;
use Phroute\Phroute\RouteCollector;

function applyRoute($url)
{
    // composer require illuminate/database
    // composer require illuminate/events

    $router = new RouteCollector();
    $router->get('/', function () {
        header('location: ' . BASE_URL . 'tai-khoan/dang-nhap');
    });
    // định nghĩa ra url mới
    $router->filter('auth', function () {
        if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])) {
            header('location: ' . BASE_URL . 'tai-khoan/dang-nhap');
            die;
        }
    });

    //mon-hoc
    $router->group(['prefix' => 'mon-hoc'], function ($router) {
        $router->get('tao-moi', [SubjectController::class, 'addForm']);
        $router->post('tao-moi', [SubjectController::class, 'saveAdd']);
        $router->get('chi-tiet/{id}', [QuizController::class, 'subjectDetail']);
        $router->get('cap-nhat/{id}', [SubjectController::class, 'editForm']);
        $router->post('cap-nhat/{id}', [SubjectController::class, 'saveEdit']);
        $router->get('xoa/{id}', [SubjectController::class, 'remove']);
        $router->get(['/{id}?', 'subject.index'], [SubjectController::class, 'index']);
    });
    //dashboard
    $router->group(['prefix' => 'dashboard', 'before' => 'auth'], function ($router) {
        $router->get('tai-khoan', [LoginController::class, 'index']);
        $router->get('mon-hoc', [SubjectController::class, 'dashoardSubject']);
        $router->get('anwer', [AnswerController::class, 'dashboardAnswer']);
        $router->get('quiz/{id}', [QuizController::class, 'dashboardQuiz']);
        $router->get('tai-khoan/cap-nhat/{id}', [LoginController::class, 'editAccount']);
        $router->post('tai-khoan/cap-nhat/{id}', [LoginController::class, 'saveEditAcoount']);
    });

    //taikhoan
    $router->group(['prefix' => 'tai-khoan'], function ($router) {
        $router->get('dang-nhap', [LoginController::class, 'login']);
        $router->post('dang-nhap', [LoginController::class, 'checklogin']);
        $router->get('dang-ki', [LoginController::class, 'addAccount']);
        $router->post('dang-ki', [LoginController::class, 'saveAccount']);
        $router->get('cap-nhat/{id}', [LoginController::class, 'editAccountView']);
        $router->post('cap-nhat/{id}', [LoginController::class, 'saveEditAccountView']);
        $router->get('xoa/{id}', [LoginController::class, 'removeAccount']);
    });


    //question
    $router->group(['prefix' => 'question', 'before' => 'auth'], function ($router) {
        $router->post('luu-tao-moi', [QuestionController::class, 'saveQuest']);
        $router->get('dang-ki', [LoginController::class, 'addAccount']);
        $router->post('dang-ki', [LoginController::class, 'saveAccount']);
        $router->get('cap-nhat/{id}', [LoginController::class, 'editAccount']);
        $router->post('cap-nhat/{id}', [SubjectController::class, 'saveEditAccountView']);
        $router->get('xoa/{id}', [QuestionController::class, 'remove']);
    });

    //answer
    $router->group(['prefix' => 'answer', 'before' => 'auth'], function ($router) {
        $router->post('luu-tao-moi', [AnswerController::class, 'saveAnswer']);
        $router->get('cap-nhat/{id}', [AnswerController::class, 'editAnswer']);
        $router->post('cap-nhat/{id}', [AnswerController::class, 'saveEditAnswer']);
        $router->get('xoa/{id}', [AnswerController::class, 'remove']);
    });




    //quiz
    $router->group(['prefix' => 'quiz', 'before' => 'auth'], function ($router) {
        $router->get('/', [QuizController::class, 'index']);
        $router->get('chi-tiet/{id}', [QuestionController::class, 'questDetail']);
        $router->get('tao-moi/{id}', [QuizController::class, 'addQuiz']);
        $router->post('tao-moi/{id}', [QuizController::class, 'saveQuiz']);
        $router->get('cap-nhat/{id}', [QuizController::class, 'editQuiz']);
        $router->post('cap-nhat/{id}', [QuizController::class, 'saveEditQuiz']);
        $router->get('xoa/{id}', [QuizController::class, 'remove']);
    });

    $router->get('thoat', function () {
        unset($_SESSION['auth']);
        header('location: ' . BASE_URL . 'tai-khoan/dang-nhap');
    });
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url, PHP_URL_PATH));

    // Print out the value returned from the dispatched function
    echo $response;
}
