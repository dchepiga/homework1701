<?php

/*1)Даны два файлы со словами, разделенными пробелами.
 Создать новый файл, содержащий:
a) строки, которые встречаются только в первом файле;
b) строки, которые встречаются в обоих файлах;
c) строки, которые встречаются в каждом файле более двух раз.*/

$fileName1 = 'words1.txt';
$fileName2 = 'words2.txt';

$fileContent1 = file_get_contents($fileName1);
$fileContent2 = file_get_contents($fileName2);

$fileContent1 = explode(' ', $fileContent1);
$fileContent2 = explode(' ', $fileContent2);

//a) task
$wordsOnlyFirstFile = array_diff($fileContent1, $fileContent2);
$wordsOnlyFirstFile = array_unique($wordsOnlyFirstFile);
$wordsOnlyFirstFile = implode(' ', $wordsOnlyFirstFile);
file_put_contents('a.txt', $wordsOnlyFirstFile);

//b) task
$wordsInTwoFiles = array_intersect($fileContent1, $fileContent2);
$wordsInTwoFiles = array_unique($wordsInTwoFiles);
$wordsInTwoFiles = implode(' ', $wordsInTwoFiles);
file_put_contents('b.txt', $wordsInTwoFiles);

//c) task

$countWord1 = array_count_values($fileContent1);
$countWord2 = array_count_values($fileContent2);

$countWord1 = extractRepeatedWords(2, $countWord1);
$countWord2 = extractRepeatedWords(2, $countWord2);

$words = array_merge($countWord1, $countWord2);
$words = array_keys($words);
$words = implode(' ', $words);
file_put_contents('c.txt', $words);



function extractRepeatedWords($repeats, $words)
{
    $arr = [];
    foreach ($words as $word => $counter) {
        if ($counter <= $repeats) {
            $arr[] = $word;
        }
    }
    foreach ($arr as $item) {
        unset($words[$item]);
    }
    return $words;
}

