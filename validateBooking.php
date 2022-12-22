<?php

declare(strict_types=1);
require("./hotelFunctions.php");

// checks if room is set
if (isset($_GET['room'])) {
    // checks if the arrival and departutre date is choosen
    if ($_GET['arrival'] === "" || $_GET['departure'] === "" || $_GET['name'] === "") {
        if ($_GET['arrival'] === "") {
            echo "please choose arrival date" . "<br>";
        }

        if ($_GET['departure'] === "") {
            echo
            "please choose departure date" . "<br>";
        }
        if ($_GET['name'] === "") {
            echo "please enter your name" . "<br>";
        }
    } else {
        // checks to make sure you cant leave before you arrive
        if ($_GET['arrival'] > $_GET['departure']) {
            echo "you can't leave before you arrive";
        } else {
            // checks wich room that is choosen
            echo "you have booked a room" . "<br>";
            if ($_GET['room'] === 1) {
                echo "you have choosen the budget room" . "<br>";
                echo $_GET['room'] . "<br>";
                echo $_GET['name'] . "<br>";
                echo $_GET['arrival'] . "<br>";
                echo $_GET['departure'] . "<br>";

                $arrivalDate = $_GET['arrival'];
                $departureDate = $_GET['departure'];
                $roomNumber = $_GET['room'];
                $name = $_GET['name'];
            } elseif ($_GET['room'] === 2) {
                echo "you have choosen the standard room" . "<br>";
                echo $_GET['room'] . "<br>";
                echo $_GET['name'] . "<br>";
                echo $_GET['arrival'] . "<br>";
                echo $_GET['departure'] . "<br>";

                $arrivalDate = $_GET['arrival'];
                $departureDate = $_GET['departure'];
                $roomNumber = $_GET['room'];
                $name = $_GET['name'];
            } elseif ($_GET['room'] === 3) {
                echo "you have choosen the luxury room" . "<br>";
                echo $_GET['room'] . "<br>";
                echo $_GET['name'] . "<br>";
                echo $_GET['arrival'] . "<br>";
                echo $_GET['departure'] . "<br>";

                $arrivalDate = $_GET['arrival'];
                $departureDate = $_GET['departure'];
                $roomNumber = $_GET['room'];
                $name = $_GET['name'];
            }
            // checks wich features are choosen
            if (isset($_GET['features'])) {
                if (in_array("breakfast", $_GET['features'])) {
                    echo "you have choosen the breakfast feature" . "<br>";
                }
                if (in_array("tour", $_GET['features'])) {
                    echo "you have choosen the tour feature" . "<br>";
                }
                if (in_array("snacks", $_GET['features'])) {
                    echo "you have choosen the snacks feature" . "<br>";
                }
            }
            createBooking($arrivalDate, $departureDate, $roomNumber, $name);
            // header("Location: ./index.php");
        }
    }
}
