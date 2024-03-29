<?php
require("./hotelFunctions.php");

$db = new PDO('sqlite:database.db');
$response = $db->query('SELECT * FROM pricelist WHERE type = "admin_feature"');
$response->execute();
$result = $response->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Images/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="/CSS/global.css">
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="stylesheet" href="/CSS/typography.css">
    <link rel="stylesheet" href="/CSS/fonts.css">
    <title>Hotel</title>
</head>

<body>
    <!-- calls a function that connects to the database to get all the reservations for the specific room -->
    <?php
    $budget = showAvailability(1);
    $standard = showAvailability(2);
    $luxury = showAvailability(3);
    ?>

    <header>
        <nav>
            <ul>
                <li>Home</li>
                <li>About</li>
                <li>Contact</li>
                <li><a href="login.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="hero">
            <img src="./Images/le-mont-saint-michel-by-night.jpg" alt="">
        </div>
        <div class="rooms">
            <div class="budget">
                <div class="calendar-wrapper">
                    <div class="calendar">
                        <h2>January 2023</h2>
                        <table cellspacing="0">
                            <tbody>
                                <tr class="weekdays">
                                    <th>M</th>
                                    <th>T</th>
                                    <th>W</th>
                                    <th>T</th>
                                    <th>F</th>
                                    <th>S</th>
                                    <th>S</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>10</td>
                                    <td>11</td>
                                    <td>12</td>
                                    <td>13</td>
                                    <td>14</td>
                                    <td>15</td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td>17</td>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                    <td>22</td>
                                </tr>
                                <tr>
                                    <td>23</td>
                                    <td>24</td>
                                    <td>25</td>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                    <td>29</td>
                                </tr>
                                <tr>
                                    <td>30</td>
                                    <td>31</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="room">
                    <div class="room-info">
                        <h3>Budget</h3>
                        <p class="room-price">3$</p>
                        <div class="description">
                            <!-- <p>The room is located in the oldest part of the castle and</p> -->
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam blanditiis quam eligendi voluptatum commodi id libero aperiam beatae eos aut dolore vitae illum mollitia possimus, eaque consectetur ipsum omnis molestiae.</p>
                        </div>
                    </div>
                    <div class="room-picture">
                        <img src="./Images/economic.jpg" alt="">
                    </div>
                </div>
            </div>

            <div class="standard">
                <div class="calendar-wrapper">
                    <div class="calendar">
                        <h2>January 2023</h2>
                        <table cellspacing="0">
                            <tr class="weekdays">
                                <th>M</th>
                                <th>T</th>
                                <th>W</th>
                                <th>T</th>
                                <th>F</th>
                                <th>S</th>
                                <th>S</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                                <td>20</td>
                                <td>21</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                                <td>26</td>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                            </tr>
                            <tr>
                                <td>30</td>
                                <td>31</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="room">
                    <div class="room-info">
                        <h3>Standard</h3>
                        <p class="room-price">5$</p>
                        <div class="description">
                            <!-- <p>The room is a bit better than budget</p> -->
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam blanditiis quam eligendi voluptatum commodi id libero aperiam beatae eos aut dolore vitae illum mollitia possimus, eaque consectetur ipsum omnis molestiae.</p>
                        </div>
                    </div>
                    <div class="room-picture">
                        <img src="./Images/standard.jpeg" alt="">
                    </div>
                </div>
            </div>

            <div class="luxury">
                <div class="calendar-wrapper">
                    <div class="calendar">
                        <h2>January 2023</h2>
                        <table cellspacing="0">
                            <tr class="weekdays">
                                <th>M</th>
                                <th>T</th>
                                <th>W</th>
                                <th>T</th>
                                <th>F</th>
                                <th>S</th>
                                <th>S</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                                <td>20</td>
                                <td>21</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                                <td>26</td>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                            </tr>
                            <tr>
                                <td>30</td>
                                <td>31</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="room">
                    <div class="room-info">
                        <h3>Luxury</h3>
                        <p class="room-price">7$</p>
                        <div class="description">
                            <!-- <p>This is our most luxourious room we have</p> -->
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam blanditiis quam eligendi voluptatum commodi id libero aperiam beatae eos aut dolore vitae illum mollitia possimus, eaque consectetur ipsum omnis molestiae.</p>
                        </div>
                    </div>
                    <div class="room-picture">
                        <img src="./Images/view.jpeg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- /validateBooking.php -->
        <form action="/validateBooking.php" method="POST">
            <div class="name-input">
                <label for="name">Name</label>
                <input class="name" type="text" name="name">
            </div>

            <div class="room-alternatives">
                <label for="room">Room</label>
                <select name="room" class="choose-room">
                    <option value="1" id="budget">Budget</option>
                    <option value="2" id="standard">Standard</option>
                    <option value="3" id="luxury">Luxury</option>
                </select>
            </div>

            <div class="form-calendars">
                <div class="form-calendar">
                    <label for="arrival">Arrival</label>
                    <input class="date" type="date" name="arrival" min="2023-01-01" max="2023-01-31" id="arrival">
                </div>

                <div class="form-calendar">
                    <label for="departure">Departure</label>
                    <input class="date" type="date" name="departure" min="2023-01-01" max="2023-01-31" id="departure">
                </div>

            </div>

            <div class="features">
                <div class="feature">
                    <input type="checkbox" name="features[]" value="4" id="breakfast">
                    <label for="features">Breakfast Buffet: </label>
                    <p>4$</p>
                </div>
                <div class="feature">
                    <input type="checkbox" name="features[]" value="5" id="tour">
                    <label for="features">Castle Tour: </label>
                    <p>5$</p>
                </div>
                <div class="feature">
                    <input type="checkbox" name="features[]" value="6" id="snacks">
                    <label for="features">Snacks Cabinet: </label>
                    <p>3$</p>
                </div>

                <?php foreach ($result as $res) : ?>
                    <div class="feature admin-feature">
                        <input type="checkbox" name="features[]" value="<?php echo $res['id']; ?>" data-price="<?php echo $res['price']; ?>" id="<?php echo $res['name']; ?>">
                        <label for="features"><?php echo $res['name']; ?> </label>
                        <p>
                            <?php echo $res['price']; ?> $
                        </p>
                    </div>

                <?php endforeach; ?>

            </div>


            <div class="total-cost">
                <h3>Total cost: </h3>
                <p>0 $</p>
            </div>

            <div class="form-transfercode">
                <label for="transfercode">Transfercode</label>
                <input class="transfer-code" type="text" name="transfercode">
            </div>

            <div class="form-button">
                <button class="submit-button" type="submit" name="submit">
                    Make reservation
                </button>
            </div>

            <div class="offer">
                <p>If you stay for 4 days or more you get one day for free</p>
            </div>

        </form>

    </main>

    <footer>

    </footer>

</body>
<script src="./script.js"></script>
<!-- javascript that shows the availability of the rooms with the information from the database -->
<script type="text/javascript">
    const budgetBookings = <?php echo json_encode($budget) ?>;
    const standardBookings = <?php echo json_encode($standard); ?>;
    const luxuryBookings = <?php echo json_encode($luxury); ?>;

    const budgetDays = document.querySelectorAll('.budget td');
    const standardDays = document.querySelectorAll('.standard td');
    const luxuryDays = document.querySelectorAll('.luxury td');

    const colorCalendar = (calendar) => {
        for (let i = 0; i < calendar.length; i++) {
            if (calendar[i].textContent === '') {
                calendar[i].style.backgroundColor = '#d9b8c4';
            }
        }
    };

    colorCalendar(budgetDays);
    colorCalendar(standardDays);
    colorCalendar(luxuryDays);

    const checkDays = (calendar, arrivalDay, departureDay) => {
        for (let i = 0; i < calendar.length; i++) {
            if (calendar[i].textContent >= arrivalDay && calendar[i].textContent <= departureDay) {
                calendar[i].style.backgroundColor = "#672E2F";
            }
        }
    }

    const checkBookings = (bookings, calendar) => {
        for (let i = 0; i < bookings.length; i++) {
            const arrival = bookings[i]['arrival_date'];
            const departure = bookings[i]['departure_date'];
            const room = bookings[i]['room_id'];

            const arrivalDay = parseInt(arrival.slice(-2));
            const departureDay = parseInt(departure.slice(-2));

            checkDays(calendar, arrivalDay, departureDay);
        }
    }

    checkBookings(budgetBookings, budgetDays);
    checkBookings(standardBookings, standardDays);
    checkBookings(luxuryBookings, luxuryDays);
</script>

</html>
