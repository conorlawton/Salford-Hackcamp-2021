<?php

// Here the raw HTML output is assembled with the database retrieved data into a lot item, ready for display.
echo
    '
<div id="Query_Post_ID">

    <div id="main_info">

        <h1 id="id">' . $this->id . '</h1>

        <p id="urgency">First Names: ' . $this->firstName . '</p>
        <p id="description">Surname: ' . $this->lastName . '</p>
        <p id="resolved">Email: ' . $this->email . '</p>
        <p id="resolved">Phone Number: ' . $this->phoneNumber . '</p>

    </div>

</div>
'

?>