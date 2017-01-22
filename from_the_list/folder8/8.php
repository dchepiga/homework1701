<?php
/*8)Счетчик посещений: Присвоить переменной $access имя файла, в котором будет храниться значение счетчика.
Использовать функцию filе( ) для чтения содержимого $access в массив $visits.
Присвоить переменной $current_visitors значение первого (и единственного) элемента массива $visits.
Увеличить значение $current_visitors на 1.
Открыть файл $access для записи и установить указатель текущей позиции в начало файла.
Записать значение $current_visitors в файл $access.
Закрыть манипулятор, ссылающийся на файл $access.
*/

$access = 'counter.txt';
$visits = file($access);

$current_visitors = $visits[0];
$current_visitors++;

$fileResource = fopen($access, 'w');

fseek($fileResource, 0);
fwrite($fileResource, $current_visitors);
fclose($fileResource);