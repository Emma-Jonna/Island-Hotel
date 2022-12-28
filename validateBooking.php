<?php

declare(strict_types=1);
require("./hotelFunctions.php");

// checks if room is set
if (isset($_GET['room'])) {
    $erros = [];

    $arrivalDate = $_GET['arrival'];
    $departureDate = $_GET['departure'];
    $name = $_GET['name'];
    $transfercode = $_GET['transfercode'];

    // checks if the arrival and departutre date is choosen
    if ($arrivalDate === "" || $departureDate === "" || $name === "" || $transfercode === "") {
        if ($arrivalDate === "") {
            // echo "please choose arrival date" . "<br>";
            $erros[] = "please choose arrival date";
        }
        if ($departureDate === "") {
            // echo "please choose departure date" . "<br>";
            $erros[] = "please choose departure date";
        }
        if ($name === "") {
            // echo "please enter your name" . "<br>";
            $erros[] = "please enter your name";
        }
        if ($transfercode === "") {
            // echo "please enter a transfercode" . "<br>";
            $erros[] = "please enter a transfercode";
        }
        if ($arrivalDate > $departureDate) {
            // echo "you can't leave before you arrive";
            $erros[] = "you can't leave before you arrive";
        }
        if ($arrivalDate === $departureDate) {
            // echo "you can't leave same day as you arrive";
            $erros[] = "you can't leave same day as you arrive";
        }

        foreach ($erros as $error) {
            echo $error . "<br>";
        }
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

        if ($days > 2) {
            $dayHalfPrice = $roomPrice / 2;
            $totalCost = ($roomPrice * $days) - $dayHalfPrice;
        } else {
            $totalCost = $roomPrice * $days;
        }

        $status = checkIfBooked($arrivalDate, $departureDate, $roomNumber);

        // print_r(count($status));

        if (count($status) === 0) {

            $insertId = createReservation($arrivalDate, $departureDate, $roomNumber);

            calcTotalCost($insertId, $name, $transfercode, $totalCost);

            // checks wich features are choosen
            if (isset($_GET['features'])) {
                insertFeatures($insertId, $_GET['features'], count($_GET['features']));
            }


            // print_r(receipt());
            header('Content-Type: application/json');
            echo (json_encode(receipt($insertId)));
        } else {
            echo "The room is already booked";
        }
    }
}
