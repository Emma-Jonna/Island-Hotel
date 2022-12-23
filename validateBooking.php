<?php

declare(strict_types=1);
require("./hotelFunctions.php");

// checks if room is set
if (isset($_GET['room'])) {
    $erros = [];
    // checks if the arrival and departutre date is choosen
    if ($_GET['arrival'] === "" || $_GET['departure'] === "" || $_GET['name'] === "" || $_GET['transfercode'] === "") {
        if ($_GET['arrival'] === "") {
            // echo "please choose arrival date" . "<br>";
            $erros[] = "please choose arrival date";
        }
        if ($_GET['departure'] === "") {
            // echo "please choose departure date" . "<br>";
            $erros[] = "please choose departure date";
        }
        if ($_GET['name'] === "") {
            // echo "please enter your name" . "<br>";
            $erros[] = "please enter your name";
        }
        if ($_GET['transfercode'] === "") {
            // echo "please enter a transfercode" . "<br>";
            $erros[] = "please enter a transfercode";
        }
        if ($_GET['arrival'] > $_GET['departure']) {
            // echo "you can't leave before you arrive";
            $erros[] = "you can't leave before you arrive";
        }

        foreach ($erros as $error) {
            echo $error . "<br>";
        }
    } else {
        // checks wich room that is choosen
        if ($_GET['room'] === "budget") {
            $arrivalDate = $_GET['arrival'];
            $departureDate = $_GET['departure'];
            $roomNumber = 1;
            $name = $_GET['name'];
            $transfercode = $_GET['transfercode'];
            $roomPrice = 1;
        } elseif ($_GET['room'] === "standard") {
            $arrivalDate = $_GET['arrival'];
            $departureDate = $_GET['departure'];
            $roomNumber = 2;
            $name = $_GET['name'];
            $transfercode = $_GET['transfercode'];
            $roomPrice = 2;
        } elseif ($_GET['room'] === "luxury") {
            $arrivalDate = $_GET['arrival'];
            $departureDate = $_GET['departure'];
            $roomNumber = 3;
            $name = $_GET['name'];
            $transfercode = $_GET['transfercode'];
            $roomPrice = 4;
        }

        $arrivalDate = $_GET['arrival'];
        $departureDate = $_GET['departure'];

        $arrival = explode("-", $arrivalDate);
        $departure = explode("-", $departureDate);

        $days = ($departure[2] - $arrival[2]) + 1;

        if ($days > 2) {
            $dayHalfPrice = $roomPrice / 2;
            $totalCost = ($roomPrice * $days) - $dayHalfPrice;
        } else {
            $totalCost = $roomPrice * $days;
        }

        $insertId = createReservation($arrivalDate, $departureDate, $roomNumber);

        calcTotalCost($insertId, $name, $transfercode, $totalCost);

        // checks wich features are choosen
        if (isset($_GET['features'])) {
            insertFeatures($insertId, $_GET['features'], count($_GET['features']));
        }


        // print_r(receipt());
        header('Content-Type: application/json');
        echo (json_encode(receipt($insertId)));
    }
}
