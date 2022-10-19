<?php

function check_login($mysqli)
{

    if (isset($_SESSION['username'])) {

        $username = $_SESSION['username'];
        $query = "select * from users where username = '$username' limit 1";

        $result = mysqli_query($mysqli, $query);
        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    header("Location: userlogin.php");
    die;
}
