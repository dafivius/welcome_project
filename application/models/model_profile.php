<?php
/**
 * Created by PhpStorm.
 * User: Leviostas
 * Date: 01.08.2017
 * Time: 20:20
 */
class Model_Profile extends Model
{

    public function __construct()
    {
        $database = new Model();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    // Получаем номера телефонов
    public function getPhones($user_id = null)
    {
        try {// Выбрать телефон и тип телефона из таблицы phones где user_id = $user_id
            $stmt = $this->conn->prepare("SELECT phone_number, phone_type FROM phones 
                                                  WHERE user_id=:user_id");
                                // SELECT phone_number, phone_type FROM phones WHERE user_id=2 ($user_id)
            $stmt->execute(array(':user_id' => $user_id)); // phone number и phone type

            $phones = $stmt->fetchAll(PDO::FETCH_ASSOC); // kil.. fetch them all

            return $phones;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    // Добавляем номера телефонов ++++++++++++++
    public function addPhone($user_id,$phone_number,$phone_type)
    {
        try
        {
            //            $stmt = $this->conn->prepare("INSERT INTO phones(user_id,phone_number,phone_type)
//                                                          VALUES (:user_id,:pnumber,:ptype)
//                                                          ON DUPLICATE KEY UPDATE phone_type=:ptype;");


            // Код ниже добавляет телефон в новую строку БД без проверки на повтор :(
            // Походу надо написать метод проверки на повтор, однако домашний может быть у нескольких пользователей
            $stmt = $this->conn->prepare("INSERT INTO phones(user_id,phone_number,phone_type)
		                                               VALUES(:user_id,:pnumber,:ptype)");



            $stmt->bindparam(":user_id", $user_id);
            $stmt->bindparam(":pnumber", $phone_number);
            $stmt->bindparam(":ptype", $phone_type); // 0 - мобильный, 1 - домашний

            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    // Регистрируем
    public function register($uname,$umail,$upass)
    {
        try
        {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass) 
		                                               VALUES(:uname, :umail, :upass)");

            $stmt->bindparam(":uname", $uname);
            $stmt->bindparam(":umail", $umail);
            $stmt->bindparam(":upass", $new_password);

            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    public function doLogin($uname,$umail,$upass)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass 
                                                    FROM users 
                                                    WHERE user_name=:uname 
                                                    OR user_email=:umail ");
            $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 1)
            {
                if(password_verify($upass, $userRow['user_pass']))
                {
                    $_SESSION['user_session'] = $userRow['user_id'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        $this->redirect("login");
        return true;
    }

    public function get_data()
    {
        // Здесь мы просто сэмулируем реальные данные.
    }

}