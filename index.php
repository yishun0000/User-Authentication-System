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
    <style>
        body {
            font-family:sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: lightgray;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
        }

        h2 {
            margin-top: 0px;
        }

        a {
            margin-right: 10px;
            color: blue;
        }


    </style>
</head>
<body>
    <div class="container">
        <div>
            <h2>My Todo List</h2>
            <a href="logout.php">Login</a>
            <a href="signup.php">Sign Up</a>
        </div>
    </div>

</body>
</html>