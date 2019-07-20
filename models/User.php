<?php 

    class User {
        // DB Stuff
        private $conn;
        private $table = 'users';

        // User Properties
        public $id;
        public $username;
        public $localisation;
        public $interacted;
        public $one;
        public $two;
        public $three;
        public $four;

        // Constructor with DB
        public function __construct($db)
        {
            $this->conn = $db;
        }

        // Get Users
        public function getAllUsers()
        {
            $query = 'SELECT * FROM ' . $this->table;

            //  Prepare Statement
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        // Get single User (tablette)
        public function getUser($user)
        {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE username= ?';

            //  Prepare Statement
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $user);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }
        public function getAllInteractions()
        {
            $query = 'SELECT * FROM interaction_time';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }
        // Interaction
        public function interact($user, $interact)
        {
            if($interact == 1)
                $column = 'one';
            if($interact == 2)
                $column = 'two';
            if($interact == 3)
                $column = 'three';
            if($interact == 4)
                $column = 'four';

            
            $query  =   'UPDATE users SET '.$column.'='.$column.' + 1 WHERE id = ?';

            $stmt  = $this->conn->prepare($query);
            $stmt->bindParam(1, $user);
            // Execute query
            if ($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
         public function interaction($user)
        {
            
            
            
            $query  =   'UPDATE users SET interacted = interacted + 1  WHERE id = ?';
            

            $stmt  = $this->conn->prepare($query);
            $stmt->bindParam(1, $user);
            // Execute query
            if ($stmt->execute()) {
                $query_two = 'INSERT INTO interaction_time (`user_id`) VALUES (?)';
                $stmt_two = $this->conn->prepare($query_two);
                $stmt_two->bindParam(1, $user);
                $stmt_two->execute();
                return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }