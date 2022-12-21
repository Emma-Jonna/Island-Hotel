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
            if ($_GET['room'] === "economy") {
                echo "you have choosen the economic room" . "<br>";
                echo $_GET['room'] . "<br>";
                echo $_GET['name'] . "<br>";
            } elseif ($_GET['room'] === "standard") {
                echo "you have choosen the standard room" . "<br>";
                echo $_GET['room'] . "<br>";
            } elseif ($_GET['room'] === "luxury") {
                echo "you have choosen the luxury room" . "<br>";
                echo $_GET['room'] . "<br>";
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
            // createBooking();
            // header("Location: ./index.php");
        }
    }
}
