<?php

declare(strict_types=1);
require("./hotelFunctions.php");

// checks if room is set
if (isset($_GET['room'])) {
    // checks if the arrival and departutre date is choosen
    if ($_GET['arrival'] === "" || $_GET['departure'] === "" || $_GET['name'] === "" || $_GET['transfercode'] === "") {
        if ($_GET['arrival'] === "") {
            echo "please choose arrival date" . "<br>";
        }
        if ($_GET['departure'] === "") {
            echo "please choose departure date" . "<br>";
        }
        if ($_GET['name'] === "") {
            echo "please enter your name" . "<br>";
        }
        if ($_GET['transfercode'] === "") {
            echo "please enter a transfercode" . "<br>";
        }
        // header("Location: ./index.php");
    } else {
        // checks to make sure you cant leave before you arrive
        if ($_GET['arrival'] > $_GET['departure']) {
            echo "you can't leave before you arrive";
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
            // checks wich features are choosen
            if (isset($_GET['features'])) {
                if (in_array("breakfast", $_GET['features'])) {
                    // echo "you have choosen the breakfast feature" . "<br>";
                }
                if (in_array("tour", $_GET['features'])) {
                    // echo "you have choosen the tour feature" . "<br>";
                }
                if (in_array("snacks", $_GET['features'])) {
                    // echo "you have choosen the snacks feature" . "<br>";
                }
                // print_r($_GET['features']);
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

            $insertId = createReservation($arrivalDate, $departureDate, $roomNumber, $name, $transfercode, $totalCost);
            // print_r(receipt());
            header('Content-Type: application/json');
            echo (json_encode(receipt($insertId)));
        }
    }
}
