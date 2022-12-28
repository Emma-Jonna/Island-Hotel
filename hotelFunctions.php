<?php

declare(strict_types=1);

/* 
Here's something to start your career as a hotel manager.

One function to connect to the database you want (it will return a PDO object which you then can use.)
    For instance: $db = connect('hotel.db');
                  $db->prepare("SELECT * FROM bookings");
                  
one function to create a guid,
and one function to control if a guid is valid.
*/

function connect(string $dbName): object
{
    $dbPath = __DIR__ . '/' . $dbName;
    $db = "sqlite:$dbPath";

    // Open the database file and catch the exception if it fails.
    try {
        $db = new PDO($db);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // echo "Connected to the database";
    } catch (PDOException $e) {
        echo "Failed to connect to the database";
        throw $e;
    }
    return $db;
}

function noEmptyFields()
{
    require("./index.php");
    $erros = [];
    // checks if the arrival and departutre date is choosen
    if ($_GET['arrival'] === "" || $_GET['departure'] === "" || $_GET['name'] === "" || $_GET['transfercode'] === "") {
        if ($_GET['arrival'] === "") {
            // echo "please choose arrival date" . "<br>";
            $erros[] = "please choose arrival date";
        }
        if ($_GET['departure'] === "") {
            // echo "please choose departure date" . "<br>";
            $erros[] = "please choose departure date";
        }
        if ($_GET['name'] === "") {
            // echo "please enter your name" . "<br>";
            $erros[] = "please enter your name";
        }
        if ($_GET['transfercode'] === "") {
            // echo "please enter a transfercode" . "<br>";
            $erros[] = "please enter a transfercode";
        }
        if ($_GET['arrival'] > $_GET['departure']) {
            // echo "you can't leave before you arrive";
            $erros[] = "you can't leave before you arrive";
        }

        foreach ($erros as $error) {
            echo $error . "<br>";
        }
    } else {
        // checks wich room that is choosen
        if ($_GET['room'] === "budget") {
            $arrivalDate = $_GET['arrival'];
            $departureDate = $_GET['departure'];
            $roomNumber = 1;
            $name = $_GET['name'];
            $transfercode = $_GET['transfercode'];
            $roomPrice = 1;
        } elseif ($_GET['room'] === "standard") {
            $arrivalDate = $_GET['arrival'];
            $departureDate = $_GET['departure'];
            $roomNumber = 2;
            $name = $_GET['name'];
            $transfercode = $_GET['transfercode'];
            $roomPrice = 2;
        } elseif ($_GET['room'] === "luxury") {
            $arrivalDate = $_GET['arrival'];
            $departureDate = $_GET['departure'];
            $roomNumber = 3;
            $name = $_GET['name'];
            $transfercode = $_GET['transfercode'];
            $roomPrice = 4;
        }

        $arrivalDate = $_GET['arrival'];
        $departureDate = $_GET['departure'];

        $arrival = explode("-", $arrivalDate);
        $departure = explode("-", $departureDate);

        $days = ($departure[2] - $arrival[2]) + 1;

        if ($days > 2) {
            $dayHalfPrice = $roomPrice / 2;
            $totalCost = ($roomPrice * $days) - $dayHalfPrice;
        } else {
            $totalCost = $roomPrice * $days;
        }

        $status = checkIfBooked($arrivalDate, $departureDate, $roomNumber);

        // print_r(count($status));

        if (count($status) === 0) {

            $insertId = createReservation($arrivalDate, $departureDate, $roomNumber);

            calcTotalCost($insertId, $name, $transfercode, $totalCost);

            // checks wich features are choosen
            if (isset($_GET['features'])) {
                insertFeatures($insertId, $_GET['features'], count($_GET['features']));
            }


            // print_r(receipt());
            header('Content-Type: application/json');
            echo (json_encode(receipt($insertId)));
        } else {
            echo "The room is already booked";
        }
    }
}

function checkIfBooked(string $arrivalDate, string $departureDate, int $roomNumber)
{
    $db = connect('database.db');

    $statement = $db->prepare(
        "SELECT * 
        FROM reservations
        WHERE room_id = ? AND 
        (arrival_date <= ? 
        or arrival_date < ?)
        AND 
        (departure_date > ? or
        departure_date > ?)"
    );

    /* "( (arrival_date<= "2023-01-07" and departure_date >="2023-01-07") or 
    (arrival_date<= "2023-01-08" and departure_date >="2023-01-08"))"; */

    $statement->bindParam(1, $roomNumber, PDO::PARAM_INT);
    $statement->bindParam(2, $arrivalDate, PDO::PARAM_STR);
    $statement->bindParam(3, $departureDate, PDO::PARAM_STR);
    $statement->bindParam(4, $arrivalDate, PDO::PARAM_STR);
    $statement->bindParam(5, $departureDate, PDO::PARAM_STR);


    $statement->execute();

    $reservations =  $statement->fetchAll(PDO::FETCH_ASSOC);

    return $reservations;
}

function insertFeatures(int $inserted_id, array $featuresArray, int $numberOfFeatures)
{
    $db = connect('database.db');

    for ($i = 0; $i < $numberOfFeatures; $i++) {
        $statement = $db->prepare(
            "INSERT INTO reservation_features (reservation_id, type_id)
            VALUES (?, ?);"
        );

        $statement->bindParam(1, $inserted_id, PDO::PARAM_STR);
        $statement->bindParam(2, $featuresArray[$i], PDO::PARAM_STR);

        $statement->execute();
    }
}

function createReservation(string $arrivalDate, string $departureDate, int $roomNumber)
{
    $db = connect('database.db');

    $statement1 = $db->prepare(
        "INSERT INTO reservations (arrival_date, departure_date, room_id, info_id)
    VALUES (?, ?, ?, 1);"
    );

    $statement1->bindParam(1, $arrivalDate, PDO::PARAM_STR);
    $statement1->bindParam(2, $departureDate, PDO::PARAM_STR);
    $statement1->bindParam(3, $roomNumber, PDO::PARAM_INT);

    $statement1->execute();

    $inserted_id = $db->lastInsertId();

    $statement2 = $db->prepare(
        "INSERT INTO reservation_features (reservation_id, type_id)
    VALUES (?, ?);"
    );

    $statement2->bindParam(1, $inserted_id, PDO::PARAM_INT);
    $statement2->bindParam(2, $roomNumber, PDO::PARAM_INT);

    $statement2->execute();

    return $inserted_id;
}

function calculateCost($inserted_id)
{
    $db = connect('database.db');

    $statement = $db->prepare(
        "SELECT SUM(pricelist.price) as total_cost
        FROM reservation_features
        INNER JOIN user_data
        on reservation_features.reservation_id = user_data.reservation_id
        INNER JOIN pricelist
        on type_id = pricelist.id
        WHERE user_data.reservation_id = ?;"
    );

    $statement->bindParam(1, $inserted_id, PDO::PARAM_STR);

    $totalCost = $statement->execute();

    return $totalCost;
}

function calcTotalCost(int $inserted_id, string $name, string $transfercode, float $totalCost)
{
    $db = connect('database.db');

    $statement = $db->prepare(
        "INSERT INTO user_data (name, total_cost, reservation_id, transfercode)
    VALUES (?, ?, ?, ?);"
    );

    $statement->bindParam(1, $name, PDO::PARAM_STR);
    $statement->bindParam(2, $totalCost, PDO::PARAM_STR);
    $statement->bindParam(3, $inserted_id, PDO::PARAM_INT);
    $statement->bindParam(4, $transfercode, PDO::PARAM_STR);

    $statement->execute();
}

function showAvailability(int $room_id)
{
    $db = connect('database.db');

    $statement = $db->prepare(
        "SELECT distinct *
        FROM reservations
        WHERE room_id = ?
        ORDER BY arrival_date"
    );

    $statement->bindParam(1, $room_id, PDO::PARAM_STR);

    $statement->execute();

    $reservations =  $statement->fetchAll(PDO::FETCH_ASSOC);

    return $reservations;
}

function receipt($reservationId)
{
    $db = connect('database.db');

    $statement = $db->prepare(
        "SELECT info.island, info.hotel, info.stars, user_data.name, arrival_date, departure_date, pricelist.name as room, total_cost, CAST(rtrim(JULIANDAY(departure_date) - JULIANDAY(arrival_date) +1, '.0') AS int) AS days_booked, info.additional_info
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


function guidv4(string $data = null): string
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function isValidUuid(string $uuid): bool
{
    if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1)) {
        return false;
    }
    return true;
}
