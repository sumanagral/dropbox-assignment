<?php

session_start();

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    if (!empty($username) && !empty($password) && !empty($fname) && !empty($lname) && !is_numeric($username)) {

        $query = "INSERT INTO users (username, fname, password, lname) VALUES ('$username', '$fname', '$password', '$lname')";
        $result = mysqli_query($mysqli, $query);
        if ($result) {
            echo "Account Created";
        } else {
            echo "Unable to create account. Username already exists or there was some error";
        }
    } else {
        echo "Enter all";
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


    <h2 style="text-align: center; margin-top: 60px;">Create New Account</h2>

    <form action="register.php" method="post">
        <div class="imgcontainer">
            <img src="images/icon.svg" style="width: 100px;" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id='username' required>
            <label for="fname"><b>First Name</label>
            <input type="text" placeholder="Enter First Name" name="fname" id='fname' required>
            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" id='lname' required>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

            <button type="submit">Create</button>
            <button onclick="location.href='index.php'" type="button" class="button button2" id="reindex" style=" background-color: #59554E">Back to Admin/User</button>
        </div>

    </form>

</body>

</html>