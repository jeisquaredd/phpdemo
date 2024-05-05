<?php
require_once('classes/database.php');
$con = new database();
 
// session_start();
// if (empty($_SESSION['username'])) {
//     header('location:login.php');
// }

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    if ($con->delete($id)) {
        header('location:index.php');
    }else{
        echo "Something went wrong.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome!</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- For Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="./includes/style.css">
</head>
<body>

<?php include('includes/navbar.php'); ?>

<div class="container user-info rounded shadow p-3 my-5">
<h2 class="text-center mb-2">User Table</h2>
  <div class="table-responsive text-center">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Birthday</th>
          <th>Sex</th>
          <th>Username</th>
          <th>Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
       
       <?php
        $counter = 1;
        $data = $con->view();
        foreach ($data as $rows) {
        ?>

        <tr>
          <td><?php echo $counter++?></td>
          <td><?php echo $rows['user_firstname']; ?></td>
          <td><?php echo $rows['user_lastname']; ?></td>
          <td><?php echo $rows['user_birthday']; ?></td>
          <td><?php echo $rows['user_sex']; ?></td>
          <td><?php echo $rows['user_name']; ?></td>
          <td><?php echo ucwords($rows['address']); ?></td>
          <td>
          <form action="update.php" method="post" style="display: inline;">
            <input type="hidden" name="id" value="<?php echo $rows['user_id']; ?>">
            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
          </form>

        <!-- Delete button -->
        <form method="POST" style="display: inline;">
            <input type="hidden" name="id" value="<?php echo $rows['user_id']; ?>">
            <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete" onclick="return confirm('Are you sure you want to delete this user?')">
        </form>
          </td>
        </tr>

        <?php
        }
        ?>

        <!-- Add more rows for additional users -->
      </tbody>
    </table>
  </div>
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