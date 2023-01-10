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
    WHERE reservation_features.reservation_id = 3 and (pricelist.id > 3 or reservation_features.type_id is null);"
);

// $statement->bindParam(1, $reservationId, PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

// print_r($result);

$features = [];

$newreceipt = [];

// print_r($feature);
// print_r($features);

if (count($result) > 1) {
    foreach ($result as $values) {
        $feature = [];
        // $features += [$name => $value];
        // print_r($array);
        // var_dump($values);
        foreach ($values as $name => $value) {
            if ($name === "features") {
                $feature += ["name" => $value];
                // echo $name;
                // echo $value;
                // array_push($feature, $value);
            } elseif ($name === "cost") {
                $feature += ["cost" => $value];
            }
            // print_r($name);
        }
        // print_r($values);
        // print_r($feature);
        // var_dump($feature);
        array_push($features, $feature);
    }
    // print_r($feature);
    // print_r($features);
    // $allFeatures = json_encode($features);
    $allFeatures = $features;

    foreach ($result as $key => $values) {
        foreach ($values as $name => $value) {
            if ($name === "features") {
                $newreceipt += [$name => $allFeatures];
            } elseif ($name === "cost") {
            } else {
                $newreceipt += [$name => $value];
            }
        }

        if (count($newreceipt) === 1) {
            break;
        }
    }
} else {
    foreach ($result as $array => $values) {
        $feature = [];
        foreach ($values as $name => $value) {
            // print_r($name);
            // print_r($value);
            if (is_null($value)) {
                // echo "hello";
                $value = "";
            } else if ($name === "features") {
                $newreceipt += [$name => $allFeatures];
            } elseif ($name === "cost") {
            } else {
                $newreceipt += [$name => $value];
            }

            if (count($newreceipt) === 1) {
                break;
            }
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
// print_r($newreceipt);
echo json_encode($newreceipt);
