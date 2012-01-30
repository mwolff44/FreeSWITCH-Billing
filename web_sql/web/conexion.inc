<?php
    $db = mysql_connect('viking_webserver_private_ip','viking','V1k1ng') or die("Couldn't connect to the database.");
    mysql_select_db('viking') or die("Couldn't select the database");
?>
