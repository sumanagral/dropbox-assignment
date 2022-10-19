<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: userlogin.php");
    exit;
}
$username = $_SESSION['username'];
$id = $_SESSION['id'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
