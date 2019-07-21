<?php

class Form
{
    // DB Stuff
    private $conn;
    private $table = 'forms';

    // Table Properties
    public $id;
    public $user_id;
    public $email;
    public $first_name;
    public $last_name;
    public $civilite;
    public $mobile;
    public $created_at;


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Users
    public function getAllForms()
    {
        $query = 'SELECT * FROM ' . $this->table;

        //  Prepare Statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //  Create Form
    public function create()
    {
        $query = 'INSERT INTO '. $this->table . ' SET
                user_id = :user_id,
                email = :email,
                first_name = :first_name,
                last_name = :last_name,
                civilite = :civilite,
                mobile = :mobile
            ';
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':civilite', $this->civilite);
        $stmt->bindParam(':mobile', $this->mobile);

        // Execute query
        if($stmt->execute())
        {
            return true;
        }
        // Print Error 
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //  Delete Form
    public function delete($id)
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Bind data
        $stmt->bindParam(':id', $id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    
}
