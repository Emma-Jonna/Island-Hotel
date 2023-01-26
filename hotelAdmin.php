<?php
session_start();



if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
}





if (isset($_POST['new-feature'], $_POST['feature-cost'])) {

    $newFeature = $_POST['new-feature'];
    $newCost = $_POST['feature-cost'];
    $type = "admin_feature";

    // echo $newFeature;
    // echo $newCost;

    $db = new PDO('sqlite:database.db');
    $query = 'INSERT INTO pricelist (type, name, price) VALUES(:type, :name, :price)';
    $stmt = $db->prepare($query);

    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':name', $newFeature, PDO::PARAM_STR);
    $stmt->bindParam(':price', $newCost, PDO::PARAM_INT);

    $stmt->execute();
}



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
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="admin-form-container">
        <form class="admin-form" method="post" action="/hotelAdmin.php">
            <div class="admin-container">
                <label for="feature-name">New feature</label>
                <input type="text" name="new-feature" required>
                <label for="feature-price">Cost</label>
                <input type="number" name="feature-cost" min="1" max="10" required>
                <button type="submit" name="submit">Add Feature</button>
            </div>
        </form>

    </div>


</body>

</html>
