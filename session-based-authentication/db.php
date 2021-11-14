<?php

function dbconn() {
    /* You should enable error reporting for mysqli before attempting to make a connection */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $conn = mysqli_connect('127.0.0.1', 'root', '', 'test');

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    return $conn;
}
