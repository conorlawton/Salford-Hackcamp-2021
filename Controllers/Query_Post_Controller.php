<?php

global $statement;

global $id;
global $urgency;
global $description;
global $resolved;

// Here each row is taken in turn as an array, the data extracted,
// then the filed data is sent off the view to be displayed to the user.
while ($row = $statement->fetch())
{

    $id = $row[0];
    $urgency = $row[1];
    $description = $row[2];
    $resolved = $row[3];

    // View is called.
    include('Small_Item_View.php');

}

?>