<?php
include("connection.php");
require "headeruser.php";
include("functionusers.php");
?>

<!DOCTYPE html>
<html>

<head>
  <title>BrowseImage</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <script src="index.js" type="text/javascript"></script>
  <link rel="icon" href="images/icon.png" />
</head>

<body>

  <!--Nav bar-->
  <?php require 'partials/_navuser.php' ?>

  <!--End nav bar-->
  <!--SIDE BAR-->
  <?php require 'partials/_sidebaruser.php' ?>
  <!--END SIDE BAR-->
  <style>
    .table,
    th,
    td {
      border-bottom: 1px solid #ddd;
      text-align: center;
      border-left: 1px solid #ddd;
      border-top: 1px solid #ddd;
      padding: 5px;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bold;
    }

    tr:hover {
      background-color: #f0f1f1;
    }

    thead th,
    tfoot th {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #a5a5a5;
    }

    body {
      background-color: #FEFCF3;
    }
  </style>
  <!--CONTENT-->
  <article class="article1">
    <section>
      <div class="contenth">
        <br>
        <h1 style="font-family: Arial, Helvetica, sans-serif">Images Uploaded By You:</h1>
        <br>
        <table class="tablelink">
          <thead>
            <tr>
              <th>Upload Time</th>
              <th>Update Time</th>
              <th>File Name</th>
              <th>Description</th>
              <th>Download Link</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            <?php

            // read all row from database table
            $query = "select * from images where username = '$username'";
            $result = mysqli_query($mysqli, $query);
            if (!$result) {
              die("Invalid query: " . $connection->error);
            }
            // read data of each row
            while ($row = $result->fetch_assoc()) {
              $linkimage = $row["link"];
              $filenametodel = $row["filename"];
              $filenametomodify = $row["filename"];

              echo "<tr>
                    <td>" . $row["uploadtime"] . "</td>
                    <td>" . $row["updatetime"] . "</td>
                    <td>" . $row["filename"] . "</td>
                    <td>" . $row["description"] . "</td>
                    <td><a href=\"$linkimage\">" . $filenametodel . "</a></td>
                    <td>
                        <form action='updateimage.php' method='post'>
                        <input type='hidden' name='modify' id='modify' value='$filenametomodify'/>
                        <input type='submit' class='buttonupload' style='background-color: #C7FFCA;   border: 1px solid black; padding: 2px;' value='UPDATE' name='submit'> 
                        </form>
                        <form action='delete.php' method='post'>
                        <input type='hidden' name='token' id='token' value='$filenametodel'/>
                        <input type='submit' class='buttonupload' style='background-color: #FFB2B2;   border: 1px solid black; padding: 2px;' value='DELETE' name='submit'>
                        </form>
                    </td>
                </tr>";
            }
            ?>
          </tbody>
        </table>

      </div>
    </section>
  </article>
  <!--END CONTENT-->
</body>

</html>