<?php

require("./hotelFunctions.php");
// require("./errors.php");

$errors = [];

$arrivalDate = $_GET['arrival'];
$departureDate = $_GET['departure'];
$name = htmlspecialchars($_GET['name'], ENT_QUOTES);
$transfercode = htmlspecialchars($_GET['transfercode'], ENT_QUOTES);

// checks if the arrival and departutre date is choosen
if ($arrivalDate === "") {
    $errors[] = "please choose arrival date";
}
if ($departureDate === "") {
    $errors[] = "please choose departure date";
}
if ($name === "") {
    $errors[] = "please enter your name";
}
if ($transfercode === "") {
    $errors[] = "please enter a transfercode";
}
if ($arrivalDate > $departureDate) {
    $errors[] = "you can't leave before you arrive";
}

if (!(count($errors) === 0)) {
    require("errors.php");
} else {
    // checks wich room that is choosen
    if ($_GET['room'] === "budget") {
        $roomNumber = 1;
        $roomPrice = 1;
    } elseif ($_GET['room'] === "standard") {
        $roomNumber = 2;
        $roomPrice = 2;
    } elseif ($_GET['room'] === "luxury") {
        $roomNumber = 3;
        $roomPrice = 4;
    }


    $arrival = explode("-", $arrivalDate);
    $departure = explode("-", $departureDate);

    $days = ($departure[2] - $arrival[2]) + 1;

    if ($days >= 5) {
        $totalCost = ($roomPrice * $days) - $roomPrice;
    } else {
        $totalCost = $roomPrice * $days;
    }

    if (isset($_GET['features'])) {
        $features = $_GET['features'];
        $featureCost = 0;
        foreach ($features as $feature) {
            $featureCost = $featureCost + $feature;
        }

        $totalCost = $totalCost + $featureCost;
    }

    $bookings = checkIfBooked($arrivalDate, $departureDate, $roomNumber);

    if (count($bookings) === 0) {

        $insertId = createReservation($arrivalDate, $departureDate, $roomNumber);

        calcTotalCost($insertId, $name, $transfercode, $totalCost);

        // checks wich features are choosen
        if (isset($_GET['features'])) {
            insertFeatures($insertId, $_GET['features'], count($_GET['features']));
        }

        header('Content-Type: application/json');

        echo (json_encode(receipt($insertId)));
    } else {
        echo "The room is already booked";
    }
}
