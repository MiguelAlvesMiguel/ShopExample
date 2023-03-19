<?php
$dbhost = "appserver-01.alunos.di.fc.ul.pt";
$dbuser = "asw27";
$dbpass = "dafonsohenriques";
$dbname = "asw27";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cria a ligação à BD
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Verifica a ligação à BD
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
}
//$filepath= 'images\afonso.jpg'; 
//echo '<img src="'.$filepath.'">'; 
////$filename = "images/afonso.jpg"; 
////$handle = fopen($filename, "rb"); 
////$contents = fread($handle, filesize($filename)); 
////fclose($handle); 
//// 
////header("content-type: image/jpeg"); 
////
////echo $contents; 
//
//$target_dir = "../images/";
//$target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
//$uploadOk = 1;
//echo $target_file;
//move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file);
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//// Check if image file is a actual image or fake image

//$check = getimagesize($_FILES["uploadfile"]["tmp_name"]);
//if($check !== false) {
//echo "File is an image - " . $check["mime"] . ".";
//$uploadOk = 1;
//} else {
//echo "File is not an image.";
//$uploadOk = 0;
//}

//if (file_exists($target_file)) {
//  echo "Sorry, file already exists.";
//  $uploadOk = 0;
//}

//if ($uploadOk == 0) {
//  echo "Sorry, your file was not uploaded.";
//// if everything is ok, try to upload file
//} else {
//  if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file)) {
//    echo "The file ". htmlspecialchars( basename( $_FILES["uploadfile"]["name"])). " has been uploaded.";
//  } else {
//    echo "Sorry, there was an error uploading your file.";
//  }
//}

?>