<?php
require_once('classes/database.php');
$con = new database();
session_start();

if (empty($_SESSION['username'])) {
    header('location:login.php');
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    if ($con->delete($id)) {
        header('location:index.php');
    }else{
        echo "Something went wrong.";
    }
}

// For Pagination

// For Pagination

// For Chart
$data = $con->getusercount();

// Check if the data is an associative array and contains the key 'male'
if (isset($data['male_count']) or isset( $dataf['female_count'])) {
    $male = $data['male_count'];
    $female = $data['female_count'];
} else {
    // Handle the case where 'male' key is not found in the returned data
    $male = 0; // or set an appropriate default value or handle the error
    $female = 0;
}

// Create the dataPoints array
$dataPoints = array( 
    array("y" => $male, "label" => "Male" ),
    array("y" => $female, "label" => "Female" ),
);

$datapoints = array(
	array("label"=> "Male", "y"=> $male),
	array("label"=> "Female", "y"=> $female),
);
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
      <tbody>
       
       <?php
        $counter = 1;
        $data = $con->view();
        foreach ($data as $rows) {
        ?>

        <tr>
          <td><?php echo $counter++?></td>
          <td>
        <?php if (!empty($rows['user_profile_picture'])): ?>
          <img src="<?php echo htmlspecialchars($rows['user_profile_picture']); ?>" alt="Profile Picture" style="width: 50px; height: 50px; border-radius: 50%;">
        <?php else: ?>
          <img src="path/to/default/profile/pic.jpg" alt="Default Profile Picture" style="width: 50px; height: 50px; border-radius: 50%;">
        <?php endif; ?>
      </td>
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

  <div class="container my-5">
        <h2 class="text-center">User Profiles</h2>
        <div class="card-container">
            <?php
            $data = $con->view();
            foreach ($data as $rows) {
            ?>
            <div class="card">
                <div class="card-body text-center">
                    <?php if (!empty($rows['user_profile_picture'])): ?>
                        <img src="<?php echo htmlspecialchars($rows['user_profile_picture']); ?>" alt="Profile Picture" class="profile-img">
                    <?php else: ?>
                        <img src="path/to/default/profile/pic.jpg" alt="Default Profile Picture" class="profile-img">
                    <?php endif; ?>
                    <h5 class="card-title"><?php echo htmlspecialchars($rows['user_firstname']) . ' ' . htmlspecialchars($rows['user_lastname']); ?></h5>
                    <p class="card-text"><strong>Birthday:</strong> <?php echo htmlspecialchars($rows['user_birthday']); ?></p>
                    <p class="card-text"><strong>Sex:</strong> <?php echo htmlspecialchars($rows['user_sex']); ?></p>
                    <p class="card-text"><strong>Username:</strong> <?php echo htmlspecialchars($rows['user_name']); ?></p>
                    <p class="card-text"><strong>Address:</strong> <?php echo ucwords(htmlspecialchars($rows['address'])); ?></p>
                    <form action="update.php" method="post" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['user_id']); ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                    </form>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['user_id']); ?>">
                        <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete" onclick="return confirm('Are you sure you want to delete this user?')">
                    </form>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

 <!-- HTML declaration for bar graph -->
  <div id="chartContainer" style="height: 370px; width: 100%;"></div>

  <!-- HTML declaration for pie chart -->
  <div id="pie" style="height: 370px; width: 100%;"></div>

</div>
<!-- Combine both chart scripts inside one window.onload -->
<script>
window.onload = function() {
  var userChart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title: {
      text: "Numbers of Users based on Sex"
    },
    axisY: {
      title: "Number of Users per Sex"
    },
    data: [{
      type: "column",
      yValueFormatString: "",
      dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
  });
  userChart.render();

  var expenseChart = new CanvasJS.Chart("pie", {
    animationEnabled: true,
    exportEnabled: true,
    title: {
      text: "Number of Users per Sex"
    },
    subtitles: [{
      text: "Total"
    }],
    data: [{
      type: "pie",
      showInLegend: "true",
      legendText: "{label}",
      indexLabelFontSize: 16,
      indexLabel: "{label} - #percent%",
      yValueFormatString: "#,##0",
      dataPoints: <?php echo json_encode($datapoints, JSON_NUMERIC_CHECK); ?>
    }]
  });
  expenseChart.render();
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