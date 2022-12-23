<?php
require("./hotelFunctions.php");
if (isset($_GET['submit'])) {
    header("Location: ./validateBooking.php");
}

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
    <!-- <img src="/Images/le-mont-saint-michel-by-night.jpg" alt=""> -->
    <!-- <img src="/Images/Best-Beaches-near-Mont-Saint-Michel.jpg" alt=""> -->
    <!-- <img src="/Images/895_0_mon-sen-mishel-smapse1.jpg" alt=""> -->
    <!-- <img src="/Images/castle.jpeg" alt=""> -->

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

        <form action="./" method="GET">
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

</html>