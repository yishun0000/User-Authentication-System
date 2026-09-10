<?php
session_start();

if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true){
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charqset="UTF-8">
    <title>Home</title>
</head>
<body>

    <h2>My Todo LIst</h2>
    <a href="login.php">Login</a>
    <a href="signup.php">Sign Up</a>

</body>
</html>