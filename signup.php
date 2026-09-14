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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family:sans-serif;
            display: flex;
            flex-direction: column;
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
            width: 80%;
        }

        h2 {
            margin: 10px 0px 20px 0px;
            border-bottom: solid 1px gray;
            text-align: center;
            padding-bottom: 20px;
        }

        input {
            width: 100%;
            border-radius: 6px;
            border: solid gray 1px;
            padding: 3px;
        }

        .email {
            margin-bottom: 20px;
        }

        .btn {
            width: 100%
        }

        a {
            text-decoration: none;
        }

    </style>
</head>
<body>
    <div class="container">

        <h2>Sign Up a New Account</h2>

        <form method="POST" action="">
            <div>
                <lable>Name<lable><br>
                <input type="name" name="name" required><br><br>
            </div>

            <div>
                <label>Email address</label><br>
                <input type="email" name="email" required><br><br>
            </div>

            <div>
                <label>Password</label><br>
                <input type="password" name="password" required><br><br>
            </div>

            <div>
                <label>Confirm Password</label><br>
                <input type="password" name="confirm_password" required><br><br>
            </div>

            <button type="submit" class="btn btn-primary px-4">Login</button>
        </form>
    </div>

    <div class="back-link mt-5">
        <a href="login.php" class="back-link"><i class="bi bi-arrow-left-circle"></i>  Go back</a>
    <div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

