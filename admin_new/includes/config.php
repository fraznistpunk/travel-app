<?php
    ob_start();
    session_start();
    // $timezone = date_default_timezone_set("Europe/London");
    $cn = mysqli_connect("localhost", "root", "", "travel");
    if(mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }
?>