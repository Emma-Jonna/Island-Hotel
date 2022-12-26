<?php
require("./hotelFunctions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/global.css">
    <link rel="stylesheet" href="./CSS/main.css">
    <link rel="stylesheet" href="./CSS/typography.css">
    <link rel="stylesheet" href="./CSS/fonts.css">
    <title>Hotel</title>
</head>

<body>
    <?php $budget = showAvailability(1);
    $standard = showAvailability(2);
    $luxury = showAvailability(3);
    foreach ($budget as $reservation) {
        echo $reservation['arrival_date'] . " " . $reservation['departure_date'] . " " . $reservation['room_id'] . "<br>";
    }
    ?>
    <div class="font-tests">
        <h1>UnifrakturCook</h1>
        <p class="one">Vollkorn-Regular</p>
        <p class="two">Vollkorn-Regular-Italic</p>
        <p class="three">Vollkorn-Medium</p>
        <p class="four">Vollkorn-Medium-Italic</p>
        <p class="five">Vollkorn-SemiBold</p>
        <p class="six">Vollkorn-SemiBold-Italic</p>
        <p class="seven">Vollkorn-Bold</p>
        <p class="eight">Vollkorn-Bold-Italic</p>
        <p class="nine">Vollkorn-ExtraBold</p>
        <p class="ten">Vollkorn-ExtraBold-Italic</p>
        <p class="eleven">Vollkorn-Black</p>
        <p class="twelve">Vollkorn-Black-Italic</p>
    </div>

    <header>
        <nav>
            <ul>
                <li>Home</li>
                <li>About</li>
                <li>Contact</li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="hero">
            <img src="./Images/le-mont-saint-michel-by-night.jpg" alt="">
        </div>
        <div class="rooms">
            <div class="budget">
                <div class="calendar">
                    <h2>January 2023</h2>
                    <table cellspacing="0">
                        <thead>
                            <tr class="weekdays">
                                <th>M</th>
                                <th>T</th>
                                <th>W</th>
                                <th>T</th>
                                <th>F</th>
                                <th>S</th>
                                <th>S</th>
                            </tr>
                        </thead>
                        <tbody>
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
                <div class="room">
                    <h3>Economy</h3>
                    <img src="./Images/economic.jpg" alt="">
                    <div class="description">
                        <p>1$</p>
                    </div>
                </div>
            </div>

            <div class="standard">
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
                <div class="room">
                    <h3>Standard</h3>
                    <img src="./Images/standard.jpeg" alt="">
                    <div class="description">
                        <p>2$</p>
                    </div>
                </div>
            </div>

            <div class="luxury">
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
                <div class="room">
                    <h3>Luxury</h3>
                    <img src="./Images/view.jpeg" alt="">
                    <div class="description">
                        <p>4$</p>
                    </div>
                </div>
            </div>
        </div>

        <form action="./validateBooking.php" method="GET">
            <label for="name">Please enter your full name</label>
            <input type="text" name="name">

            <label for="room">Room</label>
            <select name="room">
                <option value="budget" id="1">Budget</option>
                <option value="standard" id="2">Standard</option>
                <option value="luxury" id="3">Luxury</option>
            </select>

            <div class="features">
                <input type="checkbox" name="features[]" value="4" id="breakfast">
                <label for="features">Breakfast Buffet</label>
                <p>2$</p>

                <input type="checkbox" name="features[]" value="5" id="tour">
                <label for="features">Castle Tour</label>
                <p>1$</p>

                <input type="checkbox" name="features[]" value="6" id="snacks">
                <label for="features">Snacks Cabinet</label>
                <p>3$</p>
            </div>

            <label for="arrival">Arrival</label>
            <input type="date" name="arrival" min="2023-01-01" max="2023-01-31" id="arrival">

            <label for="departure">Departure</label>
            <input type="date" name="departure" min="2023-01-01" max="2023-01-31" id="departure">

            <label for="transfercode">Transfercode</label>
            <input type="text" name="transfercode">

            <button type="submit" name="submit">
                Make reservation
            </button>
        </form>

    </main>

    <footer>

    </footer>

</body>
<script src="./script.js"></script>
<script type="text/javascript">
    const budgetBookings = <?php echo json_encode($budget) ?>;
    const standardBookings = <?php echo json_encode($standard); ?>;
    const luxuryBookings = <?php echo json_encode($luxury); ?>;
    // console.log(budgetBookings, standardBookings, luxuryBookings);

    const budgetDays = document.querySelectorAll('.budget td');
    const standardDays = document.querySelectorAll('.standard td');
    const luxuryDays = document.querySelectorAll('.luxury td');

    colorCalendar(budgetDays);
    colorCalendar(standardDays);
    colorCalendar(luxuryDays);

    const checkDays = (calendar, arrivalDay, departureDay) => {
        for (let i = 0; i < calendar.length; i++) {
            // console.log(calendar[i].textContent);
            if (calendar[i].textContent === '') {
                calendar[i].style.backgroundColor = '#5a3e62';
            }
            if (calendar[i].textContent >= arrivalDay && calendar[i].textContent <= departureDay) {
                calendar[i].style.backgroundColor = "#702632";
            }
        }
    }

    const checkBookings = (bookings, calendar) => {
        for (let i = 0; i < bookings.length; i++) {
            const arrival = bookings[i]['arrival_date'];
            const departure = bookings[i]['departure_date'];
            const room = bookings[i]['room_id'];
            // console.log(arrival, departure, room);

            const arrivalDay = parseInt(arrival.slice(-2));
            const departureDay = parseInt(departure.slice(-2));

            // console.log(arrivalDay, departureDay);
            checkDays(calendar, arrivalDay, departureDay);

        }
    }
    checkBookings(budgetBookings, budgetDays);

    checkBookings(standardBookings, standardDays);

    checkBookings(luxuryBookings, luxuryDays);
</script>

</html>