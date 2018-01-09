<?php
    
function randomNumber() {
    $random = bin2hex(mcrypt_create_iv(2, MCRYPT_DEV_URANDOM));
    return $random;
}

function isImage($file) {
    if ((exif_imagetype($file) != IMAGETYPE_GIF) && (exif_imagetype($file) != IMAGETYPE_PNG) && (exif_imagetype($file) != IMAGETYPE_JPEG)) {
        return false;
    } else {
        return true;
    }
}

function renameImage ($photo, $articleId) {
    $imageFileType = pathinfo($photo['name'],PATHINFO_EXTENSION);
    $name = pathinfo($photo['name'])['filename'];
    $newName = $articleId.'-'.$name.'-'.randomNumber().".".$imageFileType;
    return $newName;
}

function moveFile($imageName, $serverLocation) {
    $upload_dir = '../uploads/'; 
    $upload_path = $upload_dir.$imageName; 
    if (!is_dir($upload_dir)) { 
        mkdir($upload_dir);
    }
    move_uploaded_file($serverLocation, $upload_path);
    return $upload_path;
    };

?>