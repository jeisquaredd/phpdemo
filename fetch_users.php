<?php
require_once('classes/database.php');
$con = new database();

try {
    $connection = $con->opencon();

    // Check for connection error
    if (!$connection) {
        echo json_encode(['error' => 'Database connection failed.']);
        exit;
    }

    // Define the number of records per page
    $recordsPerPage = 1;

    // Get the current page number from the request, default to 1 if not set
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $recordsPerPage;

    // Fetch users for the current page
    $query = $connection->prepare("SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_birthday, users.user_sex, users.user_name, users.user_profile_picture, CONCAT(user_address.city, ', ', user_address.province) AS address FROM users INNER JOIN user_address ON users.user_id = user_address.user_id LIMIT :offset, :recordsPerPage");
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
    $query->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    $html = '';

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

    echo $html;

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
