<?php

class database{

    function opencon(){
        return new PDO('mysql:host=localhost; dbname=student', 'root', '');
    }

    function check($username, $password){
        $con = $this->opencon();
        $query = "Select * from login WHERE username=' ".$username." '&&password=' ".$password." ' ";
        return $con->query($query)->fetch();
    }

    function signup($username, $password)
{
    $con = $this->opencon();
    
    // Check if the username already exists
    $query = $con->prepare("SELECT username FROM login WHERE username = ?");
    $query->execute([$username]);
    $existingUser = $query->fetch();

    // If the username already exists, return false
    if ($existingUser) {
        return false;
    }
    
    // Insert the new username and password into the database
    return $con->prepare("INSERT INTO login (username, password) VALUES (?, ?)")
                ->execute([$username, $password]);
}

    function signupUser($username, $password)
    {
        $con = $this->opencon();
        $con->prepare("INSERT INTO users (user_name, user_pass) VALUES (?, ?)")->execute([$username, $password]);
            return $con->lastInsertId();
    }

    function insertAddress($user_id, $city, $province)
    {
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_address (user_id, city, province) VALUES (?, ?, ?)")->execute([$user_id, $city, $province]);
          
    }

}