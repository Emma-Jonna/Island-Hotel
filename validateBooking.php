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
    } else {
        // checks to make sure you cant leave before you arrive
        if ($_GET['arrival'] > $_GET['departure']) {
            echo "you can't leave before you arrive";
        } else {
            // checks wich room that is choosen
            // echo "you have booked a room" . "<br>";
            if ($_GET['room'] === "budget") {
                /* echo "you have choosen the budget room" . "<br>";
                echo $_GET['room'] . "<br>";
                echo $_GET['name'] . "<br>";
                echo $_GET['arrival'] . "<br>";
                echo $_GET['departure'] . "<br>";
                echo $_GET['transfercode'] . "<br>"; */

                $arrivalDate = $_GET['arrival'];
                $departureDate = $_GET['departure'];
                $roomNumber = 1;
                $name = $_GET['name'];
                $transfercode = $_GET['transfercode'];
                $roomPrice = 1;
            } elseif ($_GET['room'] === "standard") {
                /* echo "you have choosen the standard room" . "<br>";
                echo $_GET['room'] . "<br>";
                echo $_GET['name'] . "<br>";
                echo $_GET['arrival'] . "<br>";
                echo $_GET['departure'] . "<br>";
                echo $_GET['transfercode'] . "<br>"; */

                $arrivalDate = $_GET['arrival'];
                $departureDate = $_GET['departure'];
                $roomNumber = 2;
                $name = $_GET['name'];
                $transfercode = $_GET['transfercode'];
                $roomPrice = 2;
            } elseif ($_GET['room'] === "luxury") {
                /* echo "you have choosen the luxury room" . "<br>";
                echo $_GET['room'] . "<br>";
                echo $_GET['name'] . "<br>";
                echo $_GET['arrival'] . "<br>";
                echo $_GET['departure'] . "<br>";
                echo $_GET['transfercode'] . "<br>"; */

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

            // var_dump($days);

            if ($days > 2) {
                $dayHalfPrice = $roomPrice / 2;
                $totalCost = ($roomPrice * $days) - $dayHalfPrice;
            } else {
                $totalCost = $roomPrice * $days;
            }

            $insertId = createBooking($arrivalDate, $departureDate, $roomNumber, $name, $transfercode, $totalCost, count($_GET['features']), $_GET['features']);
            // print_r(receipt());
            header('Content-Type: application/json');
            echo (json_encode(receipt($insertId)));
            // header("Location: ./index.php");
        }
    }
}
