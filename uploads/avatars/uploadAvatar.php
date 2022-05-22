<?php
    include('../../global.php');

    $request = request();

    $get = $_GET;
    $session = $get["session"] ?? 'no';

    $user = fetchAuthUser([
        "auth"=>[
            "session"=>$session
        ]
    ], $request['ip']);

    $target_dir = "/uploads/avatars";
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Aquest fitxer ja existeix";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["avatar"]["size"] > 500000) {
        echo "Fitxer massa gran";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Les imatges han de ser de tipus JPG, JPEG, PNG o GIF.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "No s'ha pogut pujar el fitxer";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $session.".".$imageFileType)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";
        } else {
        echo "No s'ha pogut pujar el fitxer";
        }
    }
?>