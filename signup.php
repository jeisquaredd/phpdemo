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
  
  <form method="post">
  <div class="form-group">
      <label for="username">First Name:</label>
      <input type="text" class="form-control  <?php if (!empty($error_message)) echo 'error-input'; ?>" name="First Name" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="username">Last Name:</label>
      <input type="text" class="form-control  <?php if (!empty($error_message)) echo 'error-input'; ?>" name="Last Name" placeholder="Enter username">
    </div>
  <div class="mb-3">
      <label for="birthday" class="form-label">Birthday:</label>
      <input type="date" class="form-control" name="birthday">
    </div>
    <div class="mb-3">
      <label for="sex" class="form-label">Sex:</label>
      <select class="form-select" name="sex">
        <option selected disabled>Select Sex</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control  <?php if (!empty($error_message)) echo 'error-input'; ?>" name="username" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label for="password">Confirm Password:</label>
      <input type="password" class="form-control" name="confirm" placeholder="Enter password">
    </div>
    <?php if (!empty($error_message)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error_message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
    <input type="submit" class="btn btn-danger btn-block" value="Sign Up" name="signup">
   
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


