<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

class database{ 

    function opencon(){
        return new PDO('mysql:host=localhost; dbname=student', 'root', '');
    }

    // function check($username, $password){
    //     $con = $this->opencon();
    //     $query = "Select * from users WHERE user_name='".$username."'&&user_pass='".$password."'";
    //     return $con->query($query)->fetch();
    // }

    function check($username, $password) {
        // Open database connection
        $con = $this->opencon();
    
        // Prepare the SQL query
        $query = $con->prepare("SELECT * FROM users WHERE user_name = ?");
        $query->execute([$username]);
    
        // Fetch the user data as an associative array
        $user = $query->fetch(PDO::FETCH_ASSOC);
    
        // If a user is found, verify the password
        if ($user && password_verify($password, $user['user_pass'])) {
            return $user;
        }
    
        // If no user is found or password is incorrect, return false
        return false;
    }

    // function signup($username, $password){
    // $con = $this->opencon();
    // // Check if the username already exists
    // $query = $con->prepare("SELECT user_name FROM users WHERE user_name = ?");
    // $query->execute([$username]);
    // $existingUser = $query->fetch();
    // // If the username already exists, return false
    // if ($existingUser) {
    //     return false;
    // }
    // // Insert the new username and password into the database
    // return $con->prepare("INSERT INTO users (user_name, user_pass) VALUES (?, ?)")->execute([$username, $password]);
    // }

    function signupUser($firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture)
    {
        $con = $this->opencon();
        // Save user data along with profile picture path to the database
        $con->prepare("INSERT INTO users (user_firstname, user_lastname, user_birthday, user_sex, user_email, user_name, user_pass, user_profile_picture) VALUES (?,?,?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture]);
        return $con->lastInsertId();
        }
    

    
    function insertAddress($user_id, $street, $barangay, $city, $province)
    {
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_address (user_id, street, barangay, city, province) VALUES (?,?,?,?,?)")->execute([$user_id, $street, $barangay,  $city, $province]);
          
    }

    function view()
        {
            $con = $this->opencon();
            return $con->query("SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_birthday, users.user_sex, users.user_name, users.user_profile_picture, CONCAT(user_address.city,', ', user_address.province) AS address from users INNER JOIN user_address ON users.user_id = user_address.user_id")->fetchAll();
        }
    
    function delete($id) 
        {
        try {
        $con = $this->opencon();
        $con->beginTransaction();

        // Delete user address
        $query = $con->prepare("DELETE FROM user_address WHERE user_id = ?");
        $query->execute([$id]);

        // Delete user
        $query2 = $con->prepare("DELETE FROM users WHERE user_id = ?");
        $query2->execute([$id]);

        $con->commit();
        return true; // Deletion successful
    } catch (PDOException $e) {
        $con->rollBack();
        return false;
    }  
}

function viewdata($id){
    try {
        $con = $this->opencon();
        $query = $con->prepare("SELECT users.user_id, users.user_name, users.user_firstname, users.user_lastname, users.user_birthday, users.user_sex, users.user_pass, users.user_profile_picture, user_address.street, user_address.barangay, user_address.city, user_address.province FROM users INNER JOIN user_address ON users.user_id = user_address.user_id WHERE users.user_id = ? ");
        $query->execute([$id]);
        return $query->fetch();
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return empty array, etc.)
        return [];
    }
}

function updateUser($user_id, $firstname, $lastname, $birthday,$sex, $username, $password) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE users SET user_firstname=?, user_lastname=?,user_birthday=?, user_sex=?,user_name=?, user_pass=? WHERE user_id=?");
        $query->execute([$firstname, $lastname,$birthday,$sex,$username, $password, $user_id]);
        // Update successful
        $con->commit();
        return true;
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
         $con->rollBack();
        return false; // Update failed
    }
}

function updateUserAddress($user_id, $street, $barangay, $city, $province){
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE user_address SET street=?, barangay=?, city=?, province=? WHERE user_id=?");
        $query->execute([$street, $barangay, $city, $province, $user_id]);
        $con->commit();
        return true; // Update successful
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
        $con->rollBack();
        return false; // Update failed
    }
}

function getusercount()
{
    $con = $this->opencon();
    return $con->query("SELECT SUM(CASE WHEN user_sex = 'Male' THEN 1 ELSE 0 END) AS male_count,
    SUM(CASE WHEN user_sex = 'Female' THEN 1 ELSE 0 END) AS female_count FROM users;")->fetch();
}

function checkEmailExists($email) {
    $con = $this->opencon();
    $query = $this->$con->prepare("SELECT user_email FROM users WHERE user_email = ?");
    $query->execute([$email]);
    return $query->fetch();
}

function validateCurrentPassword($userId, $currentPassword) {
    // Open database connection
    $con = $this->opencon();

    // Prepare the SQL query
    $query = $con->prepare("SELECT user_pass FROM users WHERE user_id = ?");
    $query->execute([$userId]);

    // Fetch the user data as an associative array
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // If a user is found, verify the password
    if ($user && password_verify($currentPassword, $user['user_pass'])) {
        return true;
    }

    // If no user is found or password is incorrect, return false
    return false;
}
function updatePassword($userId, $hashedPassword){
try {
    $con = $this->opencon();
    $con->beginTransaction();
    $query = $con->prepare("UPDATE users SET user_pass = ? WHERE user_id = ?");
    $query->execute([$hashedPassword, $userId]);
    // Update successful
    $con->commit();
    return true;
} catch (PDOException $e) {
    // Handle the exception (e.g., log error, return false, etc.)
     $con->rollBack();
    return false; // Update failed
}
}

 function updateUserProfilePicture($userID, $profilePicturePath) {
try {
    $con = $this->opencon();
    $con->beginTransaction();
    $query = $con->prepare("UPDATE users SET user_profile_picture = ? WHERE user_id = ?");
    $query->execute([$profilePicturePath, $userID]);
    // Update successful
    $con->commit();
    return true;
} catch (PDOException $e) {
    // Handle the exception (e.g., log error, return false, etc.)
     $con->rollBack();
    return false; // Update failed
}
 }
 function fetchAvailableCourses($userId) {
    try {
        $con = $this->opencon();
        $query = $con->prepare("
            SELECT c.course_id, c.course_name, c.course_description,
            CASE WHEN e.course_id IS NOT NULL THEN 'Enrolled' ELSE 'Not Enrolled' END AS enrolled_status
            FROM courses c
            LEFT JOIN enrollments e ON c.course_id = e.course_id AND e.user_id = ?
            WHERE e.course_id IS NULL OR e.user_id != ?
        ");
        $query->execute([$userId, $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
        return [];
    }
}

 function fetchSelectedCourses($selectedCourseIds) {
    try {
        $con = $this->opencon();
        $placeholders = str_repeat('?,', count($selectedCourseIds) - 1) . '?';
        $query = $con->prepare("SELECT course_id, course_name, course_description FROM courses WHERE course_id IN ($placeholders)");
        $query->execute($selectedCourseIds);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
        return [];
    }
}

}