<?php
/**
 * Created by PhpStorm.
 * User: Leviostas
 * Date: 02.08.2017
 * Time: 19:43
 */
class Controller_Restore extends Controller
{
    function __construct()
    {
        $this->model = new Model_Restore();
        $this->view = new View();
    }

    function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }

    function action_index()
    {
        if($_SESSION['user_session']) {
            $this->model->redirect("profile");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $isemail = $this->model->checkEmail($email);
            if($isemail == false) {
                $data = "Email не найден!";
            } else {
                $pass = $this->generatePassword(10); // генерим новый пароль для пользователя
                $this->model->changePassword($isemail,$pass); // меняем пароль
                // заголовок письма
                $headers= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
                $headers .= "From: Welcome <admin@leviostas.ru>\r\n"; // от кого письмо
                // Ниже вставляем $isemail - кому, $pass - сгенерированный
                $result = mail($isemail, 'Ваш пароль от leviostas.ru', 'Ваш новый пароль: '.$pass, $headers); // отправляем письмо

                if($result === true){
                    $data = "Письмо успешно отправлено";
                }else{
                    $data = "Письмо не отправлено. Ошибка: " . $result;
                }

                // $data = $sendstatus;
            }

            //$data = $this->model->doLogin($name,$email,$pass);
            //$this->model->redirect("login"); // после логина переходим в профиль
        }

        // Если пользователь залогинен, то перекидываем на другую страницу - profile
        if($this->model->is_loggedin() == true) {
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        } else {
            //$data = $this->model->get_data();
            $this->view->generate('restore_view.php', 'template_view.php', $data);
        }
    }
}