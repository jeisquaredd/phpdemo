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