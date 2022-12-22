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

function createBooking(string $arrivalDate, string $departureDate, int $roomNumber, string $name, string $transfercode, float $totalCost, int $numberOfFeatures, array $featuresArray)
{
    $dbName = 'database.db';

    $db = connect($dbName);

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

    $statement3 = $db->prepare(
        "INSERT INTO user_data (name, total_cost, reservation_id, transfercode)
    VALUES (?, ?, ?, ?);"
    );

    $statement3->bindParam(1, $name, PDO::PARAM_STR);
    $statement3->bindParam(2, $totalCost, PDO::PARAM_STR);
    $statement3->bindParam(3, $inserted_id, PDO::PARAM_INT);
    $statement3->bindParam(4, $transfercode, PDO::PARAM_STR);

    $statement3->execute();

    return $inserted_id;
}

function receipt($reservationId)
{

    $dbName = 'database.db';

    $db = connect($dbName);

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

    // $statement->bindParam(1, $reservationId, PDO::PARAM_INT);

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
