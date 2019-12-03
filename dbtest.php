<?php
    error_reporting(e_all);
    ini_set('display_errors', 'On');
    $dbc = mysqli_connect("localhost", "root", "sesame");
    
    if (!$dbc) {
        echo "<p>Unable to conect to MySQL</p>";
    } else if (!mysqli_select_db($dbc, "club")) {
        echo "<p>Inside MySQL: no Club.sql</p>";
    } else {
        echo "<p>Connected to Club.sql!</p>";
    }
?>