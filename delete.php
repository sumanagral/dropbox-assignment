<?php
include("connection.php");
require "headeruser.php";
require 'vendor/autoload.php';
include("envo.php");

use Aws\S3\S3Client;
use Aws\Exception\AwsException;


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $filenametodel = $_POST['token'];
    $keyName = 'test_example/' . basename($filenametodel);
    $pathInS3 = 'https://s3.us-west-1.amazonaws.com/' . $bucketName . '/' . $keyName;

    try {
        $query = "DELETE FROM images WHERE filename='$filenametodel'";
        $result = mysqli_query($mysqli, $query);

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

    try {
        $result = $s3->deleteObject([
            'Bucket' => $bucketName,
            'Key' => $keyName,
        ]);
    } catch (S3Exception $e) {
        echo $e->getMessage() . "\n";
    }
    echo "Object Deleted.";
    header("Location: browse.php");
}
