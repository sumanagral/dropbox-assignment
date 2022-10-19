<?php
include("connection.php");
require "headeruser.php";
require 'vendor/autoload.php';
include("envo.php");

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$filenametomodify = $_POST['modify'];
$keyName = 'test_example/' . basename($_FILES["fileToUpload"]['name']);
$pathInS3 = 'https://s3.us-west-1.amazonaws.com/' . $bucketName . '/' . $keyName;
$namefile = basename($_FILES["fileToUpload"]['name']);
$description = $_POST['description'];


echo $filenametomodify;
echo $namefile;
echo '<br>';
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
if ($filenametomodify == $namefile) {
    echo 'match';
    try {
        $query = "UPDATE images SET updatetime = CURRENT_TIMESTAMP, description='$description' WHERE filename='$filenametomodify'";
        $result = mysqli_query($mysqli, $query);

        try {
            $result = $s3->deleteObject([
                'Bucket' => $bucketName,
                'Key' => $keyName,
            ]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
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
} else {
    echo 'File names are different!';
}
