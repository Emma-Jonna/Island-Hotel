<?php

require("./hotelFunctions.php");
require "./vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

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

    // $client = new Client();

    /* When working with data from other sources, it can be convenient to put your code in a try/catch-block, because if something bad happens, it can be caught in the catch-section and handled there. */
    /* try {
        $response = $client->request(
            'POST',
            'https://www.yrgopelago.se/centralbank/transferCode',
            [
                'query' => [
                    'transferCode' => '',
                    'totalcost' => 'bar'
                ]
            ]
        );
    } catch (ClientException $e) {
        echo $e->getMessage();
    }
 */
    /* If we got some response, we will create a variable and put all the decoded content in there. */
    // if ($response->getBody()) {
    /* $horses = json_decode($response->getBody()->getContents());

        // Then we can use the data in what way we want.
        foreach ($horses->horses as $horse) {
            echo $horse->name . "<p>";
        } */
    // }

    if (count($bookings) === 0) {

        $insertId = createReservation($arrivalDate, $departureDate, $roomNumber);

        calcTotalCost($insertId, $name, $transfercode, $totalCost);

        // checks wich features are choosen
        if (isset($_POST['features'])) {
            insertFeatures($insertId, $_POST['features'], count($_POST['features']));
        }

        header('Content-Type: application/json');

        echo (json_encode(receipt($insertId)));
    } else {
        echo "The room is already booked";
    }
}
