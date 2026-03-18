<?php
session_start();
require "config/db.php";

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($password,$user["password"])){
        $_SESSION["user"] = $user["username"];
        header("Location:index.php");
        exit();
    } else {
        $error = "Login incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f0f2f5;
        }
        form {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            width: 350px;
            text-align: center;
        }
        form h2 {
            margin-bottom: 25px;
            color: #2d3436;
        }
        form input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: 0.3s;
        }
        form input:focus {
            border-color: #3498db;
            outline: none;
        }
        form button {
            width: 100%;
            padding: 12px;
            background: #2ecc71;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        form button:hover {
            background: #27ae60;
        }
        .error {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }
        .login-footer {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }
        .login-footer a {
            color: #3498db;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
    </style> -->
</head>
<body class="login-page">
    <form method="POST">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <?php if($error): ?>
            <div class="error"><?php echo $error ?></div>
        <?php endif; ?>
        
    </form>
</body>
</html>