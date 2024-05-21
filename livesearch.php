<?php
require_once('classes/database.php');
session_start();
// Initialize the database connection
$con = new database();
$html = ''; // Initialize empty variable for user table content

try {
    $connection = $con->opencon();

    // Check for connection error
    if (!$connection) {
        echo json_encode(['error' => 'Database connection failed.']);
        exit;
    }

    // Initial fetching of users
    $query = $connection->prepare("SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_birthday, users.user_sex, users.user_name, users.user_profile_picture, CONCAT(user_address.city,', ', user_address.province) AS address FROM users INNER JOIN user_address ON users.user_id = user_address.user_id");
    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        $html .= '<tr>';
        $html .= '<td>' . $user['user_id'] . '</td>';
        $html .= '<td><img src="' . htmlspecialchars($user['user_profile_picture']) . '" alt="Profile Picture" style="width: 50px; height: 50px; border-radius: 50%;"></td>';
        $html .= '<td>' . $user['user_firstname'] . '</td>';
        $html .= '<td>' . $user['user_lastname'] . '</td>';
        $html .= '<td>' . $user['user_birthday'] . '</td>';
        $html .= '<td>' . $user['user_sex'] . '</td>';
        $html .= '<td>' . $user['user_name'] . '</td>';
        $html .= '<td>' . $user['address'] . '</td>';
        $html .= '<td>'; // Action column
        $html .= '<form action="update.php" method="post" style="display: inline;">';
        $html .= '<input type="hidden" name="id" value="' . $user['user_id'] . '">';
        $html .= '<button type="submit" class="btn btn-primary btn-sm">Edit</button>';
        $html .= '</form>';
        $html .= '<form method="POST" style="display: inline;">';
        $html .= '<input type="hidden" name="id" value="' . $user['user_id'] . '">';
        $html .= '<input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete" onclick="return confirm(\'Are you sure you want to delete this user?\')">';
        $html .= '</form>';
        $html .= '</td>';
        $html .= '</tr>';
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Live Search!</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- For Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="includes/style.css?v=<?php echo time(); ?>">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<?php include('includes/navbar.php'); ?>
<div class="container user-info rounded shadow p-3 my-5">
    <h2 class="text-center mb-2">User Table</h2>
    <!-- Search input -->
    <div class="mb-3">
        <input type="text" id="search" class="form-control" placeholder="Search users...">
    </div>
    <div class="table-responsive text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User_ID</th>
                    <th>Picture</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Sex</th>
                    <th>Username</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <?php echo $html; ?>
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
<!-- For Charts -->
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<!-- script na nagpapagana ng live search -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var search = $(this).val();
            $.ajax({
                url: 'live_search.php', 
                method: 'POST',
                data: {search: search},
                success: function(response) {
                    $('#userTableBody').html(response);
                }
            });
        });
    });
</script>
</body>
</html>
