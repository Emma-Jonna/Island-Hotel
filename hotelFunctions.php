<?php

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
        echo "Connected to the database";
    } catch (PDOException $e) {
        echo "Failed to connect to the database";
        throw $e;
    }
    return $db;
}


/* $db = connect($dbName);

$statement = $db->prepare('SELECT * FROM pricelist');

$statement->execute();

$pricelist = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($pricelist as $name) {
    echo "<br>" . $name['name'] . "<br>";
} */
function createBooking(int $arrivalDate, int $departureDate, int $roomNb, string $name)
{
    $dbName = 'database.db';

    $db = connect($dbName);

    $statement1 = $db->prepare(
        "INSERT INTO reservations (arrival_date, departure_date, room)
    VALUES ('2023-01-02', '2023-01-05', 3);"
    );

    $statement1->execute();

    $statement2 = $db->prepare(
        "INSERT INTO reservation_features (reservation_id, type_id)
    VALUES (2, 3);"
    );

    $statement2->execute();

    $statement3 = $db->prepare(
        "INSERT INTO user_data (name, total_cost, reservations_id, transfercode)
    VALUES ('johanna', 4, 2, 'ifjesriojfioesrjgeios');"
    );

    $statement3->execute();
}



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
