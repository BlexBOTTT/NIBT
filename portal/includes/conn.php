<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nibt";

    // Connection  <= to MYSQL
    $conn = new mysqli($servername, $username, $password, $dbname);

    session_start();
