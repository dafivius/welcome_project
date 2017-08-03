<?php
/**
 * Created by PhpStorm.
 * User: Leviostas
 * Date: 01.08.2017
 * Time: 19:32
 */
class Controller_Signup extends Controller
{

    function __construct()
    {
        $this->model = new Model_Signup();
        $this->view = new View();
    }

    // Получаем данные для Логина методом пост, и раскидываем по переменным
    function action_index()
    {
        if($_SESSION['user_session']) {
            $this->model->redirect("profile");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            //Регаемся
            $data = $this->model->register($name,$email,$pass);
            //session_start(); // сессия для нового пользователя?
            $this->model->redirect("profile"); // после регистрации переходим в профиль
        }
        // Если пользователь залогинен, то перекидываем на другую страницу - ПОКА ЭТО НЕ РАБОТАЕТ
        if($this->model->is_loggedin() == true) {
            //$this->model->redirect("profile");
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        } else {
            $this->view->generate('signup_view.php', 'template_view.php', $data);
        }
    }
}