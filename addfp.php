<?php
if(!empty($_POST['type'])) {
    foreach($_POST['type'] as $type) {
        echo $type; //echoes the value set in the HTML form for each checked checkbox.
        //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
        //in your case, it would echo whatever $row['Report ID'] is equivalent to.
    }
}

?>