<?php
// namespace TaskManagement\Model;

class Authentication
{
    // Get user data for login
    public function getUserData($email, $db){

        $sql = "SELECT * FROM app_user WHERE email_address = :email";

        //Prepares a statement for execution and returns a statement object
        $pdostm = $db->prepare($sql);

        //Binds a parameter to the specified variable name
        $pdostm->bindParam(':email' , $email );
        
        //Execute
        $pdostm->execute();
        
        //Fetch a result row as an associative array
        return $user = $pdostm->fetch(\PDO::FETCH_ASSOC);
        
    }

    // Register a new user
    public function registerUserData($fname, $lname, $email, $password, $db){
        $sql = "INSERT INTO app_user ( first_name, last_name, password, email_address) VALUES (:fname, :lname, :password, :email)";
    
        // Prepares a statement for execution and returns a statement object
        $pdostm = $db->prepare($sql);

        //Binds a parameter to the specified variable name
        $pdostm->bindParam(':fname' , $fname );
        $pdostm->bindParam(':lname' , $lname );
        $pdostm->bindParam(':password' , $password );
        $pdostm->bindParam(':email' , $email );
        
        //Execute
        return $user = $pdostm->execute();
    }

    
}