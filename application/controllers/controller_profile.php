<?php
/**
 * Created by PhpStorm.
 * User: Leviostas
 * Date: 01.08.2017
 * Time: 20:19
 */
class Controller_Profile extends Controller
{

    function __construct()
    {
        $this->model = new Model_Profile();
        $this->view = new View();
    }

    function action_index()
    {
        // Шутка дня - сам бы себя уволил за такой код)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($_POST['logout'] == "logout"){
                $this->model->doLogout();
            }
            if($_POST['phone']) { // and $_POST['option'] - прикольный баг - мобильник означает нуль в строке, которая
                // приводится как false при сравнении. Косяк архитектуры.
                $user_id = $_SESSION['user_session']; // В сессии ID это строка, поэтому переделываем в целое число
                $phone_number = $_POST['phone'];
                $phone_type = $_POST['option'];

                $this->model->addPhone($user_id,$phone_number,$phone_type);
            }

        }

        // переход в логин если не залогинен
        if(!$_SESSION['user_session']) {
            $this->model->redirect("login");
        }

        //Список телефонов
         $data = $this->model->getPhones($_SESSION['user_session']);

        // лучше б этого никто не видел)
//        if(!$_SESSION['user_session']) {
//            $this->view->generate('login_view.php', 'template_view.php', $data);
//        }
        // Если пользователь залогинен, то перекидываем на другую страницу - profile (пока этой страницы нету)
        if($this->model->is_loggedin() == true) {
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        } else {
            $this->view->generate('login_view.php', 'template_view.php', $data);
        }
    }
}