<?php

include_once 'dbConfig.php';
$statusMag = "";

$targetDir = "uploads/";

if(isset($_POST['submit'])){
    if(!empty($_FILES["file"]["name"])){
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir.$fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        $allowTypes = array('jpg','jpeg','png','gif','pdf');
        if(in_array($fileType,$allowTypes)){
            if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFilePath)){
                $insert = $db->query("INSERT INTO images(file_name, upload_on ) VALUES ('".$fileName."', NOW()) ");
                if($insert){
                    $statusMag = "The file ".$fileName. "has been upload seccessfuly.";
                    header("location: pagepost_ad.php");
                } else {
                    $statusMag = "File upload failed, please try again";
                    header("location: pagepost_ad.php");
                }
            }else {
                $statusMag = "Sorry, ";
                header("location: pagepost_ad.php");
            }
        }else {
            $statusMag = "Sorry, only JPG , JPEG , PNG , GIF";
            header("location: pagepost_ad.php");
        }
    }else {
        $statusMag = "Please select a file to upload";
        header("location: pagepost_ad.php");
    }
}

?>
