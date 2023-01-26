<?php

declare(strict_types=1);

require("./hotelFunctions.php");
require __DIR__ . "/vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

$errors = [];

$arrivalDate = $_POST['arrival'];
$departureDate = $_POST['departure'];
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$transfercode = htmlspecialchars($_POST['transfercode'], ENT_QUOTES);

// checks if any of the inputfields ar empty or incorrect
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
    $roomNumber = (int) $_POST['room'];
    $roomPrice = checkPrice($_POST['room']);

    $arrival = explode("-", $arrivalDate);
    $departure = explode("-", $departureDate);

    $days = ($departure[2] - $arrival[2]) + 1;
    $totalCost = 0;

    // calculating the total cost of the room
    if ($days >= 4) {
        $totalCost = ($roomPrice * $days) - $roomPrice;
    } else {
        $totalCost = $roomPrice * $days;
    }

    // calculating the features cost if they are choosen and are then added
    if (isset($_POST['features'])) {
        $features = $_POST['features'];


        foreach ($features as $feature) {
            $featureCost = checkPrice($feature);

            $totalCost = $totalCost + $featureCost;
        }
    }

    $bookings = checkIfBooked($arrivalDate, $departureDate, $roomNumber);

    // check if valid and unused

    // check amount

    // check bookings

    // if all clear transfer money

    // show receipt

    $client = new Client();
    $headers = [
        'Content-Type' => 'application/x-www-form-urlencoded'
    ];
    $options = [
        'form_params' => [
            'transferCode' => $transfercode,
            'totalcost' => '1'
        ]
    ];
    $request = new Request('POST', 'http://yrgopelago.se/centralbank/transferCode', $headers);
    $response = $client->sendAsync($request, $options)->wait();
    $status = json_decode($response->getBody()->getContents(), true);

    if (!(count($status) > 1)) {
        $errors[] = "the voucher is not valid or have been used";
        require("errors.php");
    } else {
        $voucher =  $status['amount'];

        if ($voucher < $totalCost) {
            $errors[] = "the voucher amount is too little";
        }
        if ($voucher > $totalCost) {
            $errors[] = "the voucher amount is too much";
        }
        if (!(count($errors) === 0)) {
            require("errors.php");
        } else {

            if (count($bookings) === 0) {

                $insertId = createReservation($arrivalDate, $departureDate, $roomNumber);

                userInformation($insertId, $name, $transfercode, $totalCost);

                // checks wich features are choosen
                if (isset($_POST['features'])) {
                    insertFeatures($insertId, $_POST['features'], count($_POST['features']));
                } else {
                    noFeatures($insertId);
                }

                $client = new Client();
                $headers = [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ];
                $options = [
                    'form_params' => [
                        'user' => 'Robin',
                        'transferCode' => $transfercode
                    ]
                ];
                $request = new Request('POST', 'http://yrgopelago.se/centralbank/deposit', $headers);
                $response = $client->sendAsync($request, $options)->wait();
                $state = json_decode($response->getBody()->getContents(), true);

                header('Content-Type: application/json');

                echo (json_encode(receipt($insertId)));
            } else {
                $errors[] = "The room is already booked";
                require("errors.php");
            }
        }
    }
}
