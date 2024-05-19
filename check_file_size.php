<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_FILES["profile_picture"])) {
        $file_size = $_FILES["profile_picture"]["size"];
        // Check if file size exceeds the limit
        if ($file_size > 500000) {
            echo json_encode(array("error" => "File size exceeds 500KB limit."));
        } else {
            echo json_encode(array("success" => "File size is within the limit."));
        }
    } else {
        echo json_encode(array("error" => "No file uploaded."));
    }
} else {
    echo json_encode(array("error" => "Invalid request."));
}
?>
