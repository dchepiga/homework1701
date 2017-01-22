<?php

/*6)Пользователю предлагается ввести имя каталога в локальной файловой системе сервера.
Сценарий PHP выводит содержимое этого каталога в следующем формате: пиктограмма,
указывающая на тип файла, имя файла, размер (или специальная пометка, если файл является каталогом),
дата и время последней модификации.*/

require_once('templates/header.html');
require_once('templates/form.html');

if (!empty($_POST['inputName'])) {
    $dirName = $_POST['inputName'];
    showListOfAllFilesAtTheDirectory($dirName);
}

require_once('templates/footer.html');

function showListOfAllFilesAtTheDirectory($dirName)
{
    if (file_exists($dirName) && is_dir($dirName)) {

        echo realpath($dirName);
        $list = scandir($dirName); //get list of files in the dir


        echo '<table class="table">';
        echo "<th>File type</th>";
        echo "<th>File name</th>";
        echo "<th>File size</th>";
        echo "<th>Modification date</th>";


        foreach ($list as $key => $file) {
            if ($file != "." && $file != "..") {
                echo '<tr>';

                echo '<td>' . setGlyphicons(filetype($dirName . '/' . $file)) . '</td>';
                echo '<td>' . $file . '</td>';
                echo '<td>' . getFileSize($dirName . '/' . $file) . '</td>';
                echo '<td>' . date("d-m-Y H:i:s.", filemtime($dirName . '/' . $file)) . '</td>';

                echo '</tr>';
            }

        }
        echo '</table>';

    }
}

function getFileSize($file)
{
    if (filetype($file) == 'dir') {
        return '~dir~';
    } else {
        $arr = ['B', 'KB', 'MB', 'GB'];
        $size = filesize($file) . '<br>';
        $i = 0;
        while ($size > 1024) {
            $size /= 1024;
            ++$i;
        }
        return ceil($size) . $arr[$i];
    }

}

function setGlyphicons($type)
{
    if ($type == 'file') {
        $icon = "<span class=\"glyphicon glyphicon-file\" aria-hidden=\"true\"></span>";
    } elseif ($type == 'dir') {
        $icon = "<span class=\"glyphicon glyphicon-folder-open\" aria-hidden=\"true\"></span>";
    } else {
        $icon = $type;
    }
    return $icon;
}


