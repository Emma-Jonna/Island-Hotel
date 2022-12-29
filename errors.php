<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/global.css">
    <link rel="stylesheet" href="./CSS/main.css">
    <link rel="stylesheet" href="./CSS/typography.css">
    <link rel="stylesheet" href="./CSS/fonts.css">
    <title>Hotel</title>
</head>

<body>
    <div class="error-container">
        <?php

        foreach ($errors as $error) {
        ?>

            <div class="errors">
                <p><?php echo $error; ?></p>
            </div>
        <?php
        }

        ?>
    </div>
    <a href="index.php">back to start</a>
    <?php
    ?>
</body>

</html>