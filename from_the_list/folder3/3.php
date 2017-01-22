<?php
/*3)Дан файл со словами. Упорядочить слова по алфавиту.*/

$fileName = 'words.txt';
$fileNameForResult = 'sorted_words.txt'; //file for output of sorted words

$fileContent = file($fileName); //read file into array
sort($fileContent);// sort the array

file_put_contents($fileNameForResult, $fileContent); //write sorted array into file

