<?php

require("./hotelFunctions.php");
require "./vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

$errors = [];

$arrivalDate = $_POST['arrival'];
$departureDate = $_POST['departure'];
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$transfercode = htmlspecialchars($_POST['transfercode'], ENT_QUOTES);

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
    $roomNumber = $_POST['room'];
    $roomPrice = checkPrice($_POST['room']);

    $arrival = explode("-", $arrivalDate);
    $departure = explode("-", $departureDate);

    $days = ($departure[2] - $arrival[2]) + 1;
    $totalCost = 0;
    // echo "init" . var_dump($totalCost) . "<br>";

    if ($days >= 5) {
        $totalCost = ($roomPrice * $days) - $roomPrice;
        // echo "more than 5 days" . var_dump($totalCost) . "<br>";
    } else {
        $totalCost = $roomPrice * $days;
        // var_dump($totalCost) . "<br>";
    }

    if (isset($_POST['features'])) {
        $features = $_POST['features'];

        foreach ($features as $feature) {
            // var_dump($feature);
            // echo "feature1" .  var_dump($totalCost) . "<br>";
            $featureCost = checkPrice($feature);
            // echo "featureCost " . $featureCost . "feature id " . $feature . "total cost " . $totalCost . "<br>";
            // echo "feature price:" . $featureTotal;
            $totalCost = $totalCost + $featureCost;
            // echo "feature2" .  var_dump($totalCost) . "<br>";
        }


        // echo "total with features" . var_dump($totalCost) . "<br>";
        // var_dump($totalCost);
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
    // header("content-type: application/json");
    // var_dump($status);

    // echo "<br>";

    // echo count($status);

    if (!(count($status) > 1)) {
        $errors[] = "the voucher has been used";
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
            // echo "voucher is unused" . "<br>";
            // var_dump($status);

            if (count($bookings) === 0) {

                $insertId = createReservation($arrivalDate, $departureDate, $roomNumber);

                calcTotalCost($insertId, $name, $transfercode, $totalCost);

                // checks wich features are choosen
                if (isset($_POST['features'])) {
                    insertFeatures($insertId, $_POST['features'], count($_POST['features']));
                }




                $client = new Client();
                $headers = [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ];
                $options = [
                    'form_params' => [
                        'user' => 'Johanna',
                        'transferCode' => $transfercode
                    ]
                ];
                $request = new Request('POST', 'http://yrgopelago.se/centralbank/deposit', $headers);
                $response = $client->sendAsync($request, $options)->wait();
                $state = json_decode($response->getBody()->getContents(), true);

                // var_dump($state);


                header('Content-Type: application/json');

                echo (json_encode(receipt($insertId)));
            } else {
                // echo "The room is already booked";
                $errors[] = "The room is already booked";
                require("errors.php");
            }
            // echo "hello";
        }
    }
}
