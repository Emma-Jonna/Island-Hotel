<img src="https://media.giphy.com/media/3oEjHDt3AyoN1CLxyU/giphy.gif" width="100%"/>

# Isle of Sgàil

Some text about your lovely island

# The Burnwood Estate

Why not add some info about the hotel of your dreams?

# Instructions

If your project requires some installation or similar, please inform your user 'bout it. For instance, if you want a more decent indentation of your .php files, you could edit [.editorconfig]('/.editorconfig').

# Code review

1. index.php:50-285 - The calendars could probably be created using a few loops.
2. index.php - Most of the index.php could be created with a few loops, and a few arrays.
3. script.js:92-102 - You have written the exact same code 3 times.
4. ISLAND-HOTEL - Try adding more comments to your code
5. script.js:23-26 - Try to use more descriptive variable names such as "budgetRoomCostPerDay" instead of "budget".
6. Images - Remember to be consistant with naming, such as capital letter in the start of a name, underscore, and hyphen.
7. validateBooking 5-6 - Remember to use dir.
8. hotelFunctions 54-76 - When working with multiple variables, I would recommend giving names to the values such as "$statement->bindParam(:roomNumber, $roomNumber, PDO::PARAM_INT)" leading to "(...)WHERE room_id = :roomNumber(...)" instead of "(...)WHERE room_id = ?(...)".
9. database.db - Consider using a more descriptive name for your database.
10. errors.php:20-29 - Using foreach/endforeach makes the code look much better.

Code reviewed by: Douglas Lindahl - https://github.com/DouglasLindahl
