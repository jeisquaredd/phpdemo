<?php
require_once('classes/database.php');
$con=new database();

$error = ""; // Initialize error variable

if (isset($_POST['login'])) {
    $username=$_POST['Username'];
    $password=$_POST['Pass_word'];
    $result=$con-> check ($username, $password);
    if ($result) {
        if ($result['Username'] == $_POST['Username'] && $result['Pass_word'] == $_POST['Pass_word']){
            $_SESSION['Username'] = $_result['Username'];
            header('location:index.php');
        } else {
            $error = "Incorrect username or password. Please try again.";
        }
    } else {
        $error = "Error occurred while logging in. Please try again.";
    }
    }
    
    ?>
   
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
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
  <h2 class="text-center mb-4">Login</h2>



 
  <form method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="Username" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="Pass_word">Password:</label>
      <input type="password" class="form-control" name="Pass_word" placeholder="Enter password">
    </div>
    <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
    <input type="submit" class="btn btn-primary btn-block" value="Log In" name="login">
   
  </form>
</div>


 
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>