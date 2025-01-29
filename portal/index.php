<?php
session_start();
if (isset($_SESSION['role'])) {
    header("location: pages/dashboard/index.php");
} else {
    // will be back when mysql-db is implemented
    header("location: pages/login/login.php");

    // header("location: pages/dashboard/index.php"); 
}

?>