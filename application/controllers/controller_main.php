<?php

class Controller_Main extends Controller
{

    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }

    // Получаем данные для Логина методом пост, и раскидываем по переменным
    function action_index()
    {
        // так себе редирект на другой контроллер - если юзер залогинен, то перекидываем на страницу профиля
        if($_SESSION['user_session']) {
            $this->model->redirect("profile");
        }

        //Регаемся
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $name = $_POST['name'];
           $email = $_POST['email'];
           $pass = $_POST['password'];

            $data = $this->model->doLogin($name,$email,$pass);
            $this->model->redirect("profile"); // после логина переходим в профиль
        }

       // Если пользователь залогинен, то перекидываем на другую страницу - profile
        if($this->model->is_loggedin() == true) {
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        } else {
            //$data = $this->model->get_data();
            $this->view->generate('login_view.php', 'template_view.php', $data);
        }

		//$this->view->generate('login_view.php', 'template_view.php', $data);


    }

}