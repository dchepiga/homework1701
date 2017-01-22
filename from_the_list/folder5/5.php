<?php
/*5)Написать функцию, которая будет показывать список всех файлов в данной папке
(поиск файлов происходит и во всех вложенных уровнях).*/

function showListOfAllFilesAtTheDirectory($dirName)
{
    if (file_exists($dirName) && is_dir($dirName)) {

        $basename = basename($dirName); //get last name component of path
        $list[$basename] = scandir($dirName); //get list of files in the dir


        foreach ($list[$basename] as $key => $file) {
            if (is_dir($dirName . '/' . $file) && $file != '.' && $file != '..') {
                //if file in the directory is directory, get list of files from there
                $list[$basename][$key] = showListOfAllFilesAtTheDirectory($dirName . "/" . $file);
            }
        }
        return $list;

    } else {
        return [];
    }
}

echo '<pre>';
print_r(showListOfAllFilesAtTheDirectory('.f.'));
echo '</pre>';
