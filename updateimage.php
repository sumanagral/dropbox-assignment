<?php
include("connection.php");
require "headeruser.php";

$filenametomodify = $_POST['modify'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>UploadImage</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script src="index.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel="icon" href="images/icon.png" />
</head>

<body>
    <!--Nav bar-->
    <?php require 'partials/_navuser.php' ?>
    <!--End nav bar-->
    <!--SIDE BAR-->
    <?php require 'partials/_sidebaruser.php' ?>

    <!--END SIDE BAR-->
    <!--CONTENT-->
    <style>
        .buttonupload {
            background-color: #000000;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 35%;
        }

        .buttonupload:hover {
            opacity: 0.8;
        }
    </style>
    <article class="article1">
        <section>
            <div class="contenth">
                <script type="text/javascript">
                    function VerifyUploadSizeIsOK() {

                        var UploadFieldID = "fileToUpload";
                        var MaxSizeInBytes = 10485760;
                        var fld = document.getElementById(UploadFieldID);
                        if (fld.files && fld.files.length == 1 && fld.files[0].size > MaxSizeInBytes) {
                            alert("The file size must be no more than " + parseInt(MaxSizeInBytes / 1024 / 1024) + "MB");
                            return false;
                        }
                        return true;
                    } // function VerifyUploadSizeIsOK()
                </script>
                <form action="update.php" method="post" enctype="multipart/form-data" style="font-size: 20px; font-weight: 300; padding:60px">
                    Select image to Update:
                    <br>
                    <input type="file" class="buttonupload" name="fileToUpload" id="fileToUpload" style="background-color: #59554E; color: white; font-weight:bold; border: 1px solid black; padding: 10px; width: 353px;">
                    <br>
                    <label for="description">Description:</label><br>
                    <textarea id="description" name="description" rows="4" cols="50">
                    </textarea>
                    <br>
                    <input type='hidden' name='modify' id='modify' value=<?php echo $filenametomodify; ?> />
                    <input type="submit" class="buttonupload" style="background-color: #C7FFCA; color: black; border: 1px solid black; font-weight:bold; padding: 10px; width: 353px;" value="Upload Image" name="submit" onclick="return VerifyUploadSizeIsOK()">
                </form>
            </div>
        </section>
    </article>
    <!--END CONTENT-->
</body>

</html>