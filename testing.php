<?php
require("./hotelFunctions.php");

function receipt($reservationId)
{
    $db = connect('database.db');

    $statement = $db->prepare(
        "SELECT info.island, info.hotel, info.stars, user_data.name, arrival_date, departure_date, pricelist.name as room, total_cost, CAST((JULIANDAY(departure_date) - JULIANDAY(arrival_date) +1) AS int) AS days_booked, info.additional_info
        FROM reservations
        INNER JOIN user_data
        on reservations.id = user_data.reservation_id
        INNER JOIN pricelist
        on pricelist.id = reservations.room_id
        INNER JOIN info
        on reservations.info_id = info.id
        WHERE reservations.id = ?;"
    );

    $statement->bindParam(1, $reservationId, PDO::PARAM_INT);

    $statement->execute();

    $receipt = $statement->fetch(PDO::FETCH_ASSOC);

    return $receipt;
};

$db = connect('database.db');

$features = [];

$statement = $db->prepare(
    "SELECT pricelist.name as feature, pricelist.price
    FROM reservation_features
    INNER JOIN pricelist
    on pricelist.id = reservation_features.type_id
    WHERE reservation_id = 2 and pricelist.id > 3"
);

// $statement->bindParam(1, $arrivalDate, PDO::PARAM_STR);

$statement->execute();

$feature = $statement->fetchAll(PDO::FETCH_ASSOC);

header("content-type: application/json");

// $features['features'] = $feature;

// $feature = json_encode($feature, true);

// print_r($features);


// var_dump($feature);

// echo $feature['features'];

// echo $features;

$info = receipt(2);

// $info = json_encode($info, true);
$info['features'] = $feature;

// $info = array_push($info, 'features', $features['features']);
// $info = json_decode($info, true);
// var_dump($info);

// array_merge($features, $info);

// $newArray = $info + $features['features'];

// var_dump($info);
// print_r($info);


// var_dump($info);

// echo $info;


// var_dump($info);

$info = json_encode($info, true);

// var_dump($info);

// var_dump($info);

// array_push($info, $features);

// var_dump($info);

// $info = json_encode($info, true);

echo $info;
