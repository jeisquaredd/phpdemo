<?php
require_once('classes/database.php');

$con = new database();
$error_message = "";

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
   
    if ($password == $confirm) {
        if ($con->signup($username, $password)) {
            header('location:login.php');
        } else {
            $error_message = "Username already exists. Please choose a different username.";
        }
    } else {
        $error_message = "Password did not match";
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
<link rel="stylesheet" href="./includes/style.css">
</head>
<body>

<div class="container-fluid login-container rounded shadow">
  <h2 class="text-center login-heading mb-2">Register Now</h2>
  
  <form method="post"id="registrationForm" >
  
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" required class="form-control" name="username" id="username" placeholder="Enter username">
      <div class="invalid-feedback">Please enter a valid username.</div>
      
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" required name="password" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label for="password">Confirm Password:</label>
      <input type="password" class="form-control" required name="confirm" placeholder="Enter password">
    </div>
    <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign Up Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to register?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" value="Sign Up" name="signup">
      </div>
    </div>
  </div>
</div>
    <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>
  </form>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('registrationForm').addEventListener('submit', function(event) {
    console.log('Form submission attempted');
    
    var password = document.getElementById('password').value;
    var confirm = document.getElementById('confirm').value;
    console.log('Password:', password);
    console.log('Confirm Password:', confirm);
    
    if (password !== confirm) {
      event.preventDefault();
      alert('Passwords do not match. Please try again.');
    }
    
    var username = document.getElementById('username').value;
    if (!isValidUsername(username)) {
      event.preventDefault();
      alert('Please enter a valid username.');
    }
  });
  
  function isValidUsername(username) {
    // Add your username validation logic here
    console.log('Username:', username);
    return username.length > 0; // Example: Check if the username is not empty
  }
</script>
</body>
</html>

