<?php

declare(strict_types=1);

if (isset($_GET['room'])) {
    if ($_GET['arrival'] === "") {
        echo "please choose arrival date" . "<br>";
    } elseif ($_GET['departure'] === "") {
        echo
        "please choose departure date" . "<br>";
    } else {

        if ($_GET['arrival'] > $_GET['departure']) {
            echo "you can't leave before you arrive";
        } else {
            echo "you have booked a room" . "<br>";
            if ($_GET['room'] === "economy") {
                echo "you have choosen the economic room" . "<br>";
            } elseif ($_GET['room'] === "standard") {
                echo "you have choosen the standard room" . "<br>";
            } elseif ($_GET['room'] === "luxury") {
                echo "you have choosen the luxury room" . "<br>";
            }

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
        }
    }
}
