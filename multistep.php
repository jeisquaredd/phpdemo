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
  <h2 class="text-center login-heading my-2"><span class="bg-primary rounded text-light p-2 mt-3">Multi-step Form Registration</span></h2>
  <form method="post">
    <!-- Step 1: Personal Information -->
    <div class="form-step" id="personalInfoSection">
        <h5 class="mt-4 text-center">Personal Information</h5>
        <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="username" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
        <button type="button" class="btn btn-primary btn-block next-step-btn" onclick="nextStep('addressSection')">Next</button>
    </div>
    
    <!-- Step 2: Address Information -->
    <div class="form-step" id="addressSection" style="display: none;">
    <h5 class="mt-4 text-center">Address Information</h5>

    <div class="form-group">
      <label for="city">City:</label>
      <input type="text" class="form-control" name="city" placeholder="City">
    </div>

    <div class="form-group">
      <label for="city">Province:</label>
      <input type="text" class="form-control" name="province" placeholder="Province">
    </div>
        <button type="button" class=" btn btn-primary btn-block prev-step-btn" onclick="prevStep('personalInfoSection')">Previous</button>
        <button type="submit" class="submit-btn">Submit</button>
    </div>
</form>
  </div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function nextStep(sectionId) {
        var currentSection = document.getElementById(sectionId);
        var nextSection = currentSection.nextElementSibling;

        currentSection.style.display = "none";
        nextSection.style.display = "block";
    }

    function prevStep(sectionId) {
        var currentSection = document.getElementById(sectionId);
        var prevSection = currentSection.previousElementSibling;

        currentSection.style.display = "none";
        prevSection.style.display = "block";
    }
</script>

</body>
</html>