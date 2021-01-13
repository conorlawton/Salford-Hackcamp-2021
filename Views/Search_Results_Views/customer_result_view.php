<?php

// Initialise Variables
global $id;
global $firstName;
global $lastName;
global $email;
global $phoneNumber;

// Here the raw HTML output is assembled with the database retrieved data into a lot item, ready for display.
echo
    '
<div id="Query_Post_ID">

    <div id="main_info">

        <h1 id="id">' . $id . '</h1>

        <p id="urgency">First Names: ' . $firstName . '</p>
        <p id="description">Surname: ' . $lastName . '</p>
        <p id="resolved">Email: ' . $email . '</p>
        <p id="resolved">Phone Number: ' . $phoneNumber . '</p>

    </div>

</div>
'

?>