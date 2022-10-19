<?php

session_start();

include("connection.php");
include("functionadmin.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password) && !is_numeric($username)) {

        $query = "select * from admin where username = '$username' limit 1";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {

                    $_SESSION['id'] = $user_data['id'];
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $user_data['username'];
                    header("Location: adminpanel.php");
                    die;
                }
            }
        }

        echo "Wrong username or password!";
    } else {
        echo "Wrong username or password!";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #FEFCF3;

        }

        form {
            border: 3px solid #f1f1f1;
            width: 500px;
            text-align: center;
            align-self: center;
            margin: auto;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #000000;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.password {
            float: right;
            padding-top: 16px;
        }

        @media screen and (max-width: 300px) {
            span.password {
                display: block;
                float: none;
            }
        }
    </style>
</head>

<body>


    <h2 style="text-align: center; margin-top: 60px;">ADMIN LOGIN</h2>

    <form action="adminlogin.php" method="post">
        <div class="imgcontainer">
            <img src="images/icon.svg" style="width: 100px;" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id='username' required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>

            <button type="submit">Login</button>
            <button onclick="location.href='index.php'" type="button" class="button button2" id="reindex" style=" background-color: #59554E">Back to Admin/User</button>
        </div>

    </form>

</body>

</html>