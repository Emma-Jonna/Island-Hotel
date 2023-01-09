<?php
require("./hotelFunctions.php");

$db = connect('database.db');

$statement = $db->prepare(
    "SELECT info.island, info.hotel, arrival_date, departure_date, total_cost, info.stars, pricelist.id as type_id, pricelist.name as features, pricelist.price as cost, info.additional_info
    FROM reservations
    INNER JOIN user_data
    on reservations.id = user_data.reservation_id
    LEFT JOIN reservation_features
    on reservation_features.reservation_id = reservations.id
    LEFT JOIN pricelist
    on pricelist.id = reservation_features.type_id
    INNER JOIN info
    on reservations.info_id = info.id
    WHERE reservation_features.reservation_id = 3 and (pricelist.id > 3 or reservation_features.type_id is null);"
);

// $statement->bindParam(1, $reservationId, PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

print_r($result);

$features = [];

$newreceipt = [];

if (count($result) > 1) {
    foreach ($result as $name => $value) {
        // $features += [$name => $value];
        print_r($value);
    }
} else {
    foreach ($result as $name => $value) {

        if ($name === "feature") {
        }

        if (!(in_array($name, $newreceipt, true))) {

            // echo "does not exist in array";
            $newreceipt += [$name => $value];
        } else {
            // echo "does exist in array";
        }

        /* echo "island: " . $receipt['island'] . "<br>";
        echo "hotel: " . $receipt['hotel'] . "<br>";
        echo "arrival_date: " . $receipt['arrival_date'] . "<br>";
        echo "departure_date: " . $receipt['departure_date'] . "<br>";
        echo "total_cost: " . $receipt['total_cost'] . "<br>";
        echo "stars: " . $receipt['stars'] . "<br>";
        echo "type_id: " . $receipt['type_id'] . "<br>";
        echo "cost: " . $receipt['cost'] . "<br>";
        echo "additional_info: " . $receipt['additional_info'] . "<br>"; */
    }
}

header('Content-Type: application/json');

echo json_encode($newreceipt);
