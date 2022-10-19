<?php
/* Database connection settings */
$host = 'dropbox-assignment.c5v9qtdaz2yk.us-east-1.rds.amazonaws.com';
$user = 'dropboxasg';
$pass = 'injection123';
$db = 's3web';
$mysqli = new mysqli($host, $user, $pass, $db, "3306") or die($mysqli->error);
