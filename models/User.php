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
            $query = 'SELECT * FROM ' . $this->table . ' WHERE id= ?';

            //  Prepare Statement
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $user);
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

        // Interactions Section Functions 
        public function getAllInteractions()
        {
            $query = 'SELECT * FROM interaction_time';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

        public function getAllRubriquesInteractions()
        {
            $query = 'SELECT SUM(one) as Mobile,SUM(two) as Avantages,SUM(three) as Cartes,SUM(four) as Ecoute FROM users';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

        public function getMaxInteraction()
        {
            $query = 'SELECT MAX(interacted) as maxed FROM users';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function getAllInteractionTime()
        {
            $query = 'SELECT HOUR(interaction_date_time) as hour, COUNT(*) as num_rows FROM interaction_time GROUP BY HOUR(interaction_date_time)';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }
        public function getEachInteractionTime($id)
        {
                $hours_array = [];
                for($i = 0; $i < 24; $i++)
                {
                    $query = 'SELECT HOUR(interaction_date_time) as hour, COUNT(*) as num_rows FROM interaction_time where user_id = ? AND HOUR(interaction_date_time) = ?';
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(1, $id);
                    $stmt->bindParam(2, $i);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if(is_null($row['hour'])){
                        $row['hour'] = $i;
                    }
                    $hours_hour_array = [
                        'heure' => $row['hour'],
                        'nombre' => $row['num_rows'],
                    ];
                    array_push($hours_array, $hours_hour_array);
                }
                $users_array = [
                    'user' => $id,
                    'hours_array' => $hours_array,
                ];
            
            return $users_array;
        }

        public function getInteractionRowsNumber()
        {
            $query = 'SELECT SUM(interacted) as interactions FROM users';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            $row = $stmt->fetch();
            return $row['interactions'];
        }
        
        public function getCurrentWeekInteractionRowsNumber()
        {
            $dt_week_start_date = date('Y-m-d 20:00:01',strtotime("last Sunday"));
            $dt_week_end_date = date('Y-m-d 20:00:00',strtotime("next Sunday"));

            $query = "SELECT COUNT(*) as interactions FROM interaction_time WHERE  interaction_date_time BETWEEN '".$dt_week_start_date ."' AND '".$dt_week_end_date."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            $row = $stmt->fetch();
            return $row['interactions'];
        }

        public function getFormsSubmittedByUser($user)
        {
            $query = 'SELECT COUNT(*) as formsNumber from forms where forms.user_id = ? ';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$user);
            $stmt->execute();
            
            $row = $stmt->fetch();

            return $row['formsNumber'];

        }

    }