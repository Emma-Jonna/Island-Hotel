<?php

declare(strict_types=1);
require __DIR__ . "/src/Admin.php";


$db = new PDO('sqlite:database.db');
$statement = $db->query('SELECT user_name, user_password FROM Admin_Login');

$admin = $statement->fetch(PDO::FETCH_ASSOC);

$adminName = $admin['user_name'];
$adminPsw = $admin['user_password'];





if (isset($_POST['submit'])) {
    $userLogin = trim(htmlspecialchars($_POST['admin-name']));
    $userPsw = trim(htmlspecialchars($_POST['admin-password']));



    $admin = new AdminLogin($adminName, $adminPsw);



    try {
        $admin->checkLogin($adminName, $adminPsw, $userLogin, $userPsw);
    } catch (\Exception $e) {
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <h2>
        <?php
        echo $e->getMessage();
        ?>
    </h2>
</body>

</html>
