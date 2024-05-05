<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- For Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="./includes/style.css">
</head>
<body>

<div class="container user-info rounded shadow p-3 my-2">
  <h2 class="text-center mt-2">User Information</h2>
  
  <!-- Personal Information Card -->
    <!-- Personal Information Card -->
    <div class="card mt-4">
    <div class="card-header">
      Personal Information
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item">
          <i class="fas fa-user list-group-item-icon"></i> First Name: John
        </li>
        <li class="list-group-item list-group-item">
          <i class="fas fa-user list-group-item-icon"></i> Last Name: Doe
        </li>
        <li class="list-group-item list-group-item">
          <i class="fas fa-birthday-cake list-group-item-icon"></i> Birthday: January 1, 1990
        </li>
        <li class="list-group-item list-group-item">
          <i class="fas fa-venus-mars list-group-item-icon"></i> Sex: Male
        </li>
        <li class="list-group-item list-group-item">
          <i class="fas fa-user-circle list-group-item-icon"></i> Username: johndoe
        </li>
      </ul>
    </div>
  </div>

  <!-- Address Information Card -->
  <div class="card mt-4">
    <div class="card-header">
      Address Information
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item">
          <i class="fas fa-map-marker-alt list-group-item-icon"></i> Street: 123 Main St
        </li>
        <li class="list-group-item list-group-item">
          <i class="fas fa-map-marker-alt list-group-item-icon"></i> Baranggay: Baranggay XYZ
        </li>
        <li class="list-group-item list-group-item">
          <i class="fas fa-city list-group-item-icon"></i> City: Metro Manila
        </li>
        <li class="list-group-item list-group-item">
          <i class="fas fa-map-marker-alt list-group-item-icon"></i> Province: NCR
        </li>
      </ul>
    </div>
  </div>

  <!-- Buttons -->
  <div class="row justify-content-center mt-4">
    <div class="col-auto">
    <form method="POST" style="display: inline;">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="submit" name="update" class="btn btn-outline-primary" value="Update" onclick="return confirm('Are you sure you want to update this user?')">
        </form>
    </div>
    <div class="col-auto">
      <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
  </div>
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