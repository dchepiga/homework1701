<?php

/*7)Пользователь загружает текстовый файл со списком ссылок.
Добавить в базу (файл на сервере) из этого файла только те ссылки, которых нет ни в базе,
ни в файле с запрещенными ссылками.*/

if (isset($_FILES["userfile"])) {
    if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {

        $uploadFileName = $_FILES['userfile']['tmp_name'];


        $dbBackupFileName = 'database_backup.txt';
        $dbFileName = 'database.txt';
        $forbiddenLinksFileName = 'forbidden_links.txt';


        if (!copy($dbBackupFileName, $dbFileName)) { //create db from backup just to show difference between them after script run
            echo "Failed to copy $dbFileName...\n";
        }

        $dbContent = file($dbBackupFileName);
        $forbiddenLinks = file($forbiddenLinksFileName);
        $uploadContent = file($uploadFileName);

        $result = array_diff($uploadContent, $dbContent, $forbiddenLinks);
        file_put_contents($dbFileName, $result, FILE_APPEND);
        header("Location: {$_SERVER['PHP_SELF']}");

    }
}
?>

<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
    Send this file:
    <input name="userfile" type="file"><br>
    <input type="submit" value="Send File">
</form>