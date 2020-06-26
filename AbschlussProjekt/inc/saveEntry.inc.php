<?php

$title = $_REQUEST['title'];
$teaser = $_REQUEST['teaser'];
$description = $_REQUEST['description'];


if($_FILES) {
    $file = $_FILES['fileUpload']['name'];
} else {
    $file = NULL;
}

$target_dir = "../upload-img/";
$uploadOK = 1;
$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Image data check
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileUpload"]["temp_name"]);
    if($check !== false) {
        echo "File is an image - " . check["mime"] . ".";
        $uploadOK = 1;
    } else {
        echo "File is not an image.";
        $uploadOK = 0;
    }
}


//Allow certain file formats
if($imageFileType != "jpg" && imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Tut uns Leid, nur JPG, JPEG, PNG & GIF files sind erlaubt.";
    $uploadOK = 0;
}
//Check if $uploadOK is set to 0 by an error
if ($uploadOK == 0) {
    echo "Tut uns Leid, ihre Datei wurde nicht hochgeladen.";
    //If ok, try upload
} else {
    if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file )) {
        echo "Die Datei " . basename($_FILES["fileUpload"]["name"]). " wurde hochgeladen.";
    } else {
        echo "Tut uns Leid, es gab ein Problem beim Hochladen Ihrer Datei";
    }
}

// echo $target_file, $imageFileType;
include('dbconnect.inc.php');

$sql = "INSERT INTO content(title, teaser, description, imgpath) VALUE ('$title', '$teaser', '$description', '$file')";
$con->query($sql);
$con->close();

if(isset($response) || $response == 1) {
    echo '<div class="alert alert-danger" role="alert">
    Beim Abspeichern ist leider ein Fehler aufgreteten!
  </div>';
}

//redirect
$URL = "/php/Abschlussprojekt/auth/editLexikon.php?uploadOK=$uploadOK";
//  ?response=$response"
            if (headers_sent() ) { echo("<script>location.href='$URL'</script>"); }
            else { header("Location: $URL"); }
