<?php

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email           = $_POST['email'];
    $password        = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if(empty($email) || empty($password) || empty($confirmPassword)){
        echo "All fields are required";
        exit;
    }

    if($password !==$confirmPassword){
        echo"Passwords do not match";
        exit;
    }

$db = new PDO("mysql:host=localhost;dbname=login_auth", 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//check if email exists

$check = $db->prepare("SELECT * FROM users WHERE email = :email");
$check ->execute([':email'=>$email]);

if($check->fetch()){
    echo"The email is already registered";
    exit;
}

$hashedPassword =password_hash($password,PASSWORD_DEFAULT);

$statement = $db->prepare("INSERT INTO users(email,password) VALUES(:email,:password)");
$statement->execute([
    ':email' =>$email,
    ':password'=>$hashedPassword,
]);

echo "Successfully registered";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h2>Sign Up a New Account</h2>

    <form method="POST" action="">
        <lable>Name:<lable>
        <input type="name" name="name" required><br><br>

        <label>Email address:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br><br>

        <button type="submit">Login</button>
    </form>

</body>
</html>

