<?php
/*4)Дан файл. Каждая строка содержит имя, пароль и email, разделенные символами ':' (двоеточие).
Удалить строки с повторами email. Удалить строки, в которых имена совпадают.*/


const USERNAME = 0;
const PASSWORD = 1;
const EMAIL = 2;


$fileName = "data.txt";
$newFileName = "new_data.txt";

$content = file($fileName);

$content = explodeNestedArrays($content);

$result1 = removeStringsByKey($content, PASSWORD);
$result2 = removeStringsByKey($result1, USERNAME);

$content = implodeNestedArrays($result2);

file_put_contents($newFileName, $content);


function removeStringsByKey($array, $key)
{
    $duplicateIndex = [];
    for ($i = 0; $i < count($array); $i++) {
        for ($j = $i + 1; $j < count($array); $j++) {
            if (strcmp($array[$j][$key], $array[$i][$key]) === 0) {
                $duplicateIndex[] = $j;
                break;
            }
        }
    }
    if (!empty($duplicateIndex)) {
        foreach ($duplicateIndex as $index) {
            unset($array[$index]);
        }
    }
    return array_values($array); // array re-index after unset()
}

function explodeNestedArrays($content)
{
    foreach ($content as &$value) {
        $value = explode(':', $value);
    }
    return $content;
}

function implodeNestedArrays($content)
{
    foreach ($content as &$value) {
        $value = implode(':', $value);
    }
    return $content;
}