<?php

if(!empty($_FILES)) {
    if ($_FILES['userfile']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['userfile']['error'] == UPLOAD_ERR_OK) {
            $dirName = 'myDir/';
            if (file_exists($dirName)) {
                $uploadFile = $dirName . basename($_FILES['userfile']['name']);
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile)) {
                    echo "File was uploaded.\n";
                } else {
                    echo "File wasn't uploaded.\n";
                }
            } else {
                echo "Folder doesn't exist\n";
            }
        } else {
            echo "File exceeds MAX_FILE_SIZE\n";
        }
    } else {
        echo "File wasn't selected\n";
    }
}

?>
<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
    Send this file: <input name="userfile" type="file">
    <input type="submit" value="Send File">
</form>
