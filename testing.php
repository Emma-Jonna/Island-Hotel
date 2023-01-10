<?php
require("./hotelFunctions.php");

$db = connect('database.db');

$statement = $db->prepare(
    "SELECT info.island, info.hotel, arrival_date, departure_date, total_cost, info.stars, pricelist.name as features, pricelist.price as cost, info.additional_info
    FROM reservations
    INNER JOIN user_data
    on reservations.id = user_data.reservation_id
    LEFT JOIN reservation_features
    on reservation_features.reservation_id = reservations.id
    LEFT JOIN pricelist
    on pricelist.id = reservation_features.type_id
    INNER JOIN info
    on reservations.info_id = info.id
    WHERE reservation_features.reservation_id = 1 and (pricelist.id > 3 or reservation_features.type_id is null);"
);

// $statement->bindParam(1, $reservationId, PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

$features = [];
$newreceipt = [];

header('Content-Type: application/json');



foreach ($result as $key => $values) {
    $feature = [];
    foreach ($values as $name => $value) {
        if ($name === "features" && !(is_null($value))) {
            $feature += ["name" => $value];
        } elseif ($name === "cost" && !(is_null($value))) {
            $feature += ["cost" => $value];
        }
    }
    array_push($features, $feature);
}

foreach ($result as $key => $values) {
    foreach ($values as $name => $value) {
        if (!($name === "cost")) {
            if ($name === "features") {
                if (empty($features)) {
                    $value = "";
                } else {
                    $value = $features;
                }
            }
            $newreceipt += [$name => $value];
        }
    }

    if (count($result) === 2) {
        break;
    }
}
echo json_encode($newreceipt);
