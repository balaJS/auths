<?php

function dbconn() {
    /* You should enable error reporting for mysqli before attempting to make a connection */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $conn = new mysqli('127.0.0.1', 'root', '', 'test');

    // Check connection
    if ($conn->connect_error) {
      error_log("Failed to connect to MySQL: " . $conn->connect_error);
      exit();
    }
    return $conn;
}
