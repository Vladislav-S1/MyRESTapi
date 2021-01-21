<?php
class IntByID {

    private $conn;
    private $table_name = "baseint";

    public $id;
    public $randomint;

    public function __construct($db){
        $this->conn = $db;
    }

    function retrieve() {

        $query = "SELECT
                    p.id, p.randomInt
                FROM
                    " . $this->table_name . " p
                WHERE
                    p.id = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->randomInt = $row['randomInt'];
    }
    function generate(){
        $query = "INSERT INTO
                " . $this->table_name . "
                SET randomInt=:randomInt";

        // prepare request 
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":randomInt", $this->randomInt);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>