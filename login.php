<?php
require __DIR__ . "/src/Admin.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Images/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="/CSS/global.css">
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="stylesheet" href="/CSS/typography.css">
    <link rel="stylesheet" href="/CSS/fonts.css">
    <title>Document</title>
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>About</li>
                <li>Contact</li>
            </ul>
        </nav>
    </header>
    <div class="login-form-container">
        <form class="login-form" action="/validateLogin.php" method="POST">
            <div class="login-container">
                <label for="Username">Username</label>
                <input type="text" name="admin-name" placeholder="Username" required>
                <label for="password">password</label>
                <input type="password" name="admin-password" placeholder="********" required>
                <button class="login-button" type="submit" name="submit">Login</button>
            </div>
        </form>

    </div>

</body>

</html>
