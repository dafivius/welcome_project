<?php
/**
 * Created by PhpStorm.
 * User: Leviostas
 * Date: 02.08.2017
 * Time: 12:52
 */
class Model_Ajax extends Model
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

    // Метод проверки наличия email'а на сервере
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

    public function get_data()
    {
        //
    }

}