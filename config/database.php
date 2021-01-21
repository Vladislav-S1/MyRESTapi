<?php
class Database {

    // db info
    private $host = "localhost";
    private $db_name = "api_for_int_db";
    private $username = "root";
    private $password = "";
    public $conn;

    // DB connection 
    public function getConnection(){

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection to DB error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    //CREATE TABLE IF NOT EXISTS`api_for_int_db`.`baseint` ( `ID` INT NOT NULL AUTO_INCREMENT , `randomInt` INT NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;
}
?>