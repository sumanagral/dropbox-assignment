<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: adminlogin.php");
    exit;
}
$username = $_SESSION['username'];
$id = $_SESSION['id'];
