<?php

function gen_random_val($length)
{
    return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
}

putenv('HOME=/var/www');

require 'vendor/autoload.php';

use Aws\S3\S3Client;

ini_set('display_errors', 1);

error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //AWS S3 UPLOAD CODE START
    // Instantiate an Amazon S3 client.
    $s3 = new S3Client([
        'version' => 'latest',
        'region'  => 'region',
        'credentials' => [
            'key'    => "aws_key",
            'secret' => "aws_secret",
        ]
    ]);

    $bucket_name = 'bucket_name';
    $folder_name = 'folder_name';

    $result_array = [];

    //    var_dump($_FILES);
    $files = $_FILES['upload_files'];

    for ($i = 0; $i < count($files['name']); $i++) {
        $temp_file_location = $files['tmp_name'][$i];
        $temp_file_name = $files['name'][$i];

        $ext = pathinfo($temp_file_name, PATHINFO_EXTENSION);

        $output = gen_random_val(10);
        // $output = strtotime('now');
        $outputname = $folder_name. '/' . $output . '.' . $ext;

        var_dump($outputname);
        try {
            $result_array[] =  $s3->putObject([
                'Bucket' => $bucket_name,
                'Key'    => $outputname,
                'Body'   => fopen($temp_file_location, 'r'),
                'ContentType'  => $file['type'],       
            ]);

        } catch (Aws\S3\Exception\S3Exception $e) {
            echo $e->getMessage();
            echo "There was an error uploading the file.\n";
        }

    }

}
