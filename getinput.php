<?php

if (isset($_POST['submit'])) 
{
    $user = $_POST["username"];
    $pass = $_POST["password"];

    echo $user . ' ' . $pass ;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="username">
        <input type="text" name="password">
        <input type="submit" name="submit">
    </form>

</body>
</html>