<?php

declare(strict_types=1);

require("./hotelFunctions.php");

// checks if room is set
if (isset($_GET['room'])) {
    noEmptyFields();
}
