<?php
/**
 * Created by PhpStorm.
 * User: Leviostas
 * Date: 02.08.2017
 * Time: 19:50
 */
class Model_Restore extends Model
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

    public function checkEmail($email) {
        try { //
            $stmt = $this->conn->prepare("SELECT user_email FROM users 
                                                  WHERE user_email=:user_email");
            //
            $stmt->execute(array(':user_email' => $email)); //

            $email = $stmt->fetchAll(PDO::FETCH_ASSOC); //

            if($email != null) { return true;} else {return false;}
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function changePassword($umail,$upass)
    {
        try {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("UPDATE users
                                        SET user_pass=:upass
                                        WHERE user_email=:umail");

            $stmt->bindparam(":umail", $umail);
            $stmt->bindparam(":upass", $new_password);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
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
        return true;
    }

    public function get_data()
    {
        //
    }
}
