<?php
include_once "session.php";

adminOnly();

include_once "db.php";

$id = (int) $_POST['id'];
$title = $_POST['title'];
$type = $_POST['type'];

//v katero mapo bo naložil multimedijo
$target_dir = "./multimedia/";
//random name generator
$random = $id.'-'.date("YmdHis")."-".rand(10,10000).'-';
$target_file = $target_dir . $random . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

switch ($type) {
    case 'img':
        // Check file size
        if ($_FILES["file"]["size"] > 5000000) {
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }
        break;
    case 'video':
        // Check file size
        if ($_FILES["file"]["size"] > 15000000) {
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "mp4" && $imageFileType != "mov" && $imageFileType != "avi") {
            $uploadOk = 0;
        }
        break;
    default:
        $uploadOk = 0;
}

// Check if $uploadOk is set to 1 - vse je ok
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        //datoteko je prestavil, zapišemo v bazo
        $query = "INSERT INTO multimedia(title,type,url,movie_id) VALUES(?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title,$type,$target_file,$id]);

    } 
}
//preusmerim nazaj na film
header("Location: movie.php?id=".$id); die();

?>