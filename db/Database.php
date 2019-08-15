<?php
// This is the Database for the API
class Database {
    //  DB Params
    private $host = 'banxy.appstanast.com';
    private $db_name = 'bdd_banxy';
    private $username = 'user_banxy';
    private $password = '2Thi~o86';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' .$this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }   catch(PDOException $e){
            echo 'Connection Error: ' . $e->getMessage(); 
        }

        return $this->conn;
    }
}
