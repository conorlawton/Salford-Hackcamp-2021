<?php

// Here the raw HTML output is assembled with the database retrieved data into a lot item, ready for display.
echo
    '
<div id="Query_Post_ID">

    <div id="main_info">

        <h1 id="id">' . $id . '</h1>

        <p id="urgency">Lot ID: ' . $urgency . '</p>
        <p id="description">Description: ' . $description . '</p>
        <p id="resolved">Auction House: ' . $resolved . '</p>

    </div>

</div>
'

?>