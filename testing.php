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
        // print_r($name);
    }
    array_push($features, $feature);
    // $allFeatures = $features;

    /* foreach ($result as $key => $values) {
        foreach ($values as $name => $value) {
            if ($name === "features") {
                if (is_null($value)) {
                    $newreceipt += [$name => ""];
                } else {
                    // $newreceipt += [$name => $allFeatures];
                    array_push($newreceipt, $features);
                }
            }
            if ($name !== "cost") {
                $newreceipt += [$name => $value];
            }
        }
        if (count($newreceipt) === 1) {
            break;
        }
    } */

    // print_r($feature);
}

// print_r($result);

// echo json_encode($features);

foreach ($result as $key => $values) {
    foreach ($values as $name => $value) {
        // print_r($features);
        // print_r($name);
        // echo json_encode($name);
        if (!($name === "cost")) {
            if ($name === "features") {
                if (empty($features)) {
                    $value = "hello";
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
    // echo count($result);
    // print_r($values);
}
// echo count($result);

// print_r($features);
// print_r($allFeatures);
// print_r($newreceipt);


/* foreach ($result as $key => $values) {
    $feature = [];
    foreach ($values as $name => $value) {
        if ($name === "features") {
            $feature += ["name" => $value];
        } elseif ($name === "cost") {
            $feature += ["cost" => $value];
        }
        // print_r($name);
    }
    array_push($features, $feature);
    $allFeatures = $features;

    foreach ($result as $key => $values) {
        foreach ($values as $name => $value) {
            if ($name === "features") {
                if (is_null($value)) {
                    $newreceipt += [$name => ""];
                } else {
                    $newreceipt += [$name => $allFeatures];
                }
            }
            if ($name !== "cost") {
                $newreceipt += [$name => $value];
            }
        }
        if (count($newreceipt) === 1) {
            // break;
        }
    }
} */

// print_r($allFeatures);
// print_r($newreceipt);

/* foreach ($result as $key => $values) {
    $feature = [];
    foreach ($values as $name => $value) {
        if ($name === "features") {
            $feature += ["name" => $value];
        } elseif ($name === "cost") {
            $feature += ["cost" => $value];
        }
        // print_r($name);
    }
    array_push($features, $feature);
    $allFeatures = $features;

    foreach ($result as $key => $values) {
        foreach ($values as $name => $value) {
            if ($name === "features") {
                if (is_null($value)) {
                    $newreceipt += [$name => ""];
                } else {
                    $newreceipt += [$name => $allFeatures];
                }
            }
            if ($name !== "cost") {
                $newreceipt += [$name => $value];
            }
        }
        if (count($newreceipt) === 1) {
            break;
        }
    }
} */





/* if (count($result) > 1) {
    foreach ($result as $values) {
        $feature = [];
        foreach ($values as $name => $value) {
            if ($name === "features") {
                $feature += ["name" => $value];
            } elseif ($name === "cost") {
                $feature += ["cost" => $value];
            }
            // print_r($name);
        }
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
            if (is_null($value)) {
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
    }
} */

// header('Content-Type: application/json');
// print_r($newreceipt);
echo json_encode($newreceipt);
