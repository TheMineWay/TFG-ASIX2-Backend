<?php

    function uploadFiles(array $files, string $location, string $extension = '*') {
        foreach($files as $file) uploadFile($file, $location, $extension);
    }

    function uploadFile($file, string $location, string $extension = '*') {
        $destdir = ($location ?? 'files').'/';
        $targetFile = $destdir.$file["name"];
        $fExt = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        
        if(file_exists($targetFile)) {
        throwHttpError("file"); // TODO: change
        }

        if($file["size"] > 10000000) { // 10MB
        throwHttpError("file"); // TODO: change
        }

        // TODO: enable image filetype (generic)
        if($extension != '*' && $extension != $fExt) {
        throwHttpError("file"); // TODO: change
        }

        // Begin upload
        $uploadResult = move_uploaded_file($file["tmp_name"], $targetFile);

        if(!$uploadResult) {
        throwHttpError("file"); // TODO: change
        }

        return true;
    }

?>