<?php
/* Database connection settings */
$host = '';
$user = '';
$pass = '';
$db = '';
$mysqli = new mysqli($host, $user, $pass, $db, "3306") or die($mysqli->error);
