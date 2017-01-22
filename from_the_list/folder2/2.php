<?php
/*2)Даны два файла, состоящие из предложений.
Создать третий файл, содержащий все предложения, которые есть хотя бы в одном из файлов.
Повторы не добавлять в третий файл.*/

$fileName1 = 'file1.txt';
$fileName2 = 'file2.txt';
$resultFileName = 'result.txt';

$fileContent1 = file($fileName1);
$fileContent2 = file($fileName2);

$content = array_merge($fileContent1,$fileContent2);
$content = array_unique($content);

file_put_contents($resultFileName,$content);



