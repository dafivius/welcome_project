<?php
/**
 * Created by PhpStorm.
 * User: Leviostas
 * Date: 02.08.2017
 * Time: 12:52
 */
class Controller_Ajax extends Controller
{
    function __construct()
    {
        $this->model = new Model_Ajax();
        $this->view = new View();
    }

    function action_index()
    {
        // Вьюшка тут не нужна
        // $this->view->generate('ajax_view.php', 'template_view.php', $data);




        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $result = $this->model->checkEmail($email);

            if($result == true) {
                echo "Email занят!";
            }else{
                echo "Email свободен";
          }
        }
    }

}