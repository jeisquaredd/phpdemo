<?php

require_once('classes/database.php');

$con = new database();
if (isset($_POST['adduser'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $confirm = $_POST['c_pass'];
    $city = $_POST['city'];
    $province = $_POST['province'];
 
    
    if ($password == $confirm) {
        // Passwords match, proceed with signup
        $user_id = $con->signupUser($username, $password); // Insert into users table and get user_id
        if ($user_id) {
            // Signup successful, insert address into users_address table
            if ($con->insertAddress($user_id, $city, $province)) {
                // Address insertion successful, redirect to login page
                header('location:login.php');
                exit();
            } else {
                // Address insertion failed, display error message
                $error = "Error occurred while signing up. Please try again.";
            }
        } else {
            // User insertion failed, display error message
            $error = "Error occurred while signing up. Please try again.";
        }
    } else {
        // Passwords don't match, display error message
        $error = "Passwords did not match. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .login-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
    }
  </style>
</head>
<body>

<div class="container-fluid login-container">
  <h2 class="text-center mb-4">Register Now</h2>
  
  <form method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="user" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="password">City:</label>
      <input type="text" class="form-control" name="city" placeholder="City">
    </div>
    <div class="form-group">
      <label for="password">Province:</label>
      <input type="text" class="form-control" name="province" placeholder="Province">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="pass" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label for="password">Confirm Password:</label>
      <input type="password" class="form-control" name="c_pass" placeholder="Enter password">
    </div>
    
    <input type="submit" class="btn btn-primary btn-block" value="Log In" name="adduser">
   
  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
