<?php
    
   putenv('HOME=/var/www');
   
   require 'vendor/autoload.php';
   use Aws\S3\S3Client;
       
  ini_set('display_errors', 1);
   
  error_reporting(E_ALL);
        
  if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
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
   
   $bucket_name='bucket_name';
   $folder_name='folder_name';
   $temp_file_location = $_FILES['upload_file']['tmp_name'];
   $temp_file_name = $_FILES['upload_file']['name'];
   
   $ext = pathinfo($temp_file_name, PATHINFO_EXTENSION);
   $output = rand(1,9);
   
    for($i=0; $i<10; $i++) {
        $output .= rand(0,9);
    }
   $outputname=$folder_name.$output.'.'.$ext;

   // Upload a publicly accessible file. The file size and type are determined by the SDK.
   try {
      $s3_result=  $s3->putObject([
           'Bucket' => $bucket_name,
           'Key'    => $outputname,
           'Body'   => fopen($temp_file_location, 'r'),
           'ContentType'  => $_FILES['upload_file']['type'],       
       ]);

       var_dump($s3_result);
   
   } catch (Aws\S3\Exception\S3Exception $e) {
       echo $e->getMessage();
       echo "There was an error uploading the file.\n";
   }
   //END AWS S3 UPLOAD CODE.
  }
   