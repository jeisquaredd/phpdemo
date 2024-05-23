<?php
require_once('classes/database.php');
$con = new database();
session_start();

if (empty($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    if ($con->delete($id)) {
        header('location:index.php');
        exit;
    } else {
        echo "Something went wrong.";
    }
}

// For Pagination
$html = ''; // Initialize empty variable for user table content

try {
    $connection = $con->opencon();

    // Check for connection error
    if (!$connection) {
        echo json_encode(['error' => 'Database connection failed.']);
        exit;
    }

    // Define the number of records per page
    $recordsPerPage = 2;

    // Get the current page number from the request, default to 1 if not set
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $recordsPerPage;

    // Get the total number of records
    $totalQuery = $connection->prepare("SELECT COUNT(*) AS total FROM users");
    $totalQuery->execute();
    $totalRecords = $totalQuery->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Fetch users for the current page
    $query = $connection->prepare("SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_birthday, users.user_sex, users.user_name, users.user_profile_picture, CONCAT(user_address.city, ', ', user_address.province) AS address FROM users INNER JOIN user_address ON users.user_id = user_address.user_id LIMIT :offset, :recordsPerPage");
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
    $query->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $rows) {
        $html .= '<td>' . htmlspecialchars($rows['user_firstname']) . '</td>';
        $html .= '<div class="card">';
        $html .= '    <div class="card-body text-center">';
        if (!empty($rows['user_profile_picture'])) {
            $html .= '        <img src="' . htmlspecialchars($rows['user_profile_picture']) . '" alt="Profile Picture" class="profile-img">';
        } else {
            $html .= '        <img src="path/to/default/profile/pic.jpg" alt="Default Profile Picture" class="profile-img">';
        }
        $html .= '        <h5 class="card-title">' . htmlspecialchars($rows['user_firstname']) . ' ' . htmlspecialchars($rows['user_lastname']) . '</h5>';
        $html .= '        <p class="card-text"><strong>Birthday:</strong> ' . htmlspecialchars($rows['user_birthday']) . '</p>';
        $html .= '        <p class="card-text"><strong>Sex:</strong> ' . htmlspecialchars($rows['user_sex']) . '</p>';
        $html .= '        <p class="card-text"><strong>Username:</strong> ' . htmlspecialchars($rows['user_name']) . '</p>';
        $html .= '        <p class="card-text"><strong>Address:</strong> ' . ucwords(htmlspecialchars($rows['address'])) . '</p>';
        $html .= '        <form action="update.php" method="post" class="d-inline">';
        $html .= '            <input type="hidden" name="id" value="' . htmlspecialchars($rows['user_id']) . '">';
        $html .= '            <button type="submit" class="btn btn-primary btn-sm">Edit</button>';
        $html .= '        </form>';
        $html .= '        <form method="POST" class="d-inline">';
        $html .= '            <input type="hidden" name="id" value="' . htmlspecialchars($rows['user_id']) . '">';
        $html .= '            <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete" onclick="return confirm(\'Are you sure you want to delete this user?\')">';
        $html .= '        </form>';
        $html .= '    </div>';
        $html .= '</div>';
    }

    // Output the pagination HTML
    $paginationHtml = '';
    if ($totalPages > 1) {
        $paginationHtml .= '<nav><ul class="pagination justify-content-center">';
        if ($currentPage > 1) {
            $paginationHtml .= '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Previous</a></li>';
        }
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = $i == $currentPage ? ' active' : '';
            $paginationHtml .= '<li class="page-item' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
        if ($currentPage < $totalPages) {
            $paginationHtml .= '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a></li>';
        }
        $paginationHtml .= '</ul></nav>';
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
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
  <link rel="stylesheet" href="includes/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<?php include('includes/navbar.php'); ?>

<div class="container user-info rounded shadow p-3 my-5">
  <div class="container my-5">
        <h2 class="text-center">User Profiles</h2>
        <div class="card-container" id="user-profiles">
            <?php echo $html; ?>
        </div>
        <?php echo $paginationHtml; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.pagination a.page-link');
    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const page = this.getAttribute('href').split('page=')[1];
            fetchUsers(page);
        });
    });
});

function fetchUsers(page) {
    fetch(`fetch_users.php?page=${page}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('user-profiles').innerHTML = data;
            updatePaginationLinks();
        })
        .catch(error => console.error('Error fetching users:', error));
}

function updatePaginationLinks() {
    const links = document.querySelectorAll('.pagination a.page-link');
    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const page = this.getAttribute('href').split('page=')[1];
            fetchUsers(page);
        });
    });
}
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- For Charts -->
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</body>
</html>
