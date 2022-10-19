<?php
include("connection.php");
require "headeruser.php";
require 'vendor/autoload.php';
include("envo.php");

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

try {
    $s3 = S3Client::factory(
        array(
            'credentials' => array(
                'key' => $IAM_KEY,
                'secret' => $IAM_SECRET
            ),
            'version' => 'latest',
            'region'  => 'us-west-1'
        )
    );
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

$description = $_POST['description'];
$pic = $_FILES["fileToUpload"]['name'];
$link = 'https://d1oswxrganiqdz.cloudfront.net/test_example/' . $pic;
$keyName = 'test_example/' . basename($_FILES["fileToUpload"]['name']);
$pathInS3 = 'https://s3.us-west-1.amazonaws.com/' . $bucketName . '/' . $keyName;

try {
    $file = $_FILES["fileToUpload"]['tmp_name'];
    $query = "INSERT INTO images (username, firstname, lastname, filename, link, description) VALUES ('$username', '$fname', '$lname','$pic','$link','$description')";
    $result = mysqli_query($mysqli, $query);
    $s3->putObject(
        array(
            'Bucket' => $bucketName,
            'Key' =>  $keyName,
            'SourceFile' => $file,
            'StorageClass' => 'REDUCED_REDUNDANCY'
        )
    );
} catch (S3Exception $e) {
    die('Error:' . $e->getMessage());
} catch (Exception $e) {
    die('Error:' . $e->getMessage());
}

echo 'Done';
header("Location: browse.php");
