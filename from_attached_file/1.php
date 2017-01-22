<?php

const FILENAME = 'database.txt';

if(!empty($_POST))
{
    if($_POST['fname'] && $_POST['lname']){
        $name = $_POST['fname'];
        $surname = $_POST['lname'];
        $string = "{$name} {$surname}\n";
        if(file_exists(FILENAME)){
            $fileResource = fopen(FILENAME,'a');
            fwrite($fileResource, $string);
            fclose($fileResource);
        }
        header("Location: {$_SERVER['PHP_SELF']}");
    }
}

?>

<h1>Заполните форму</h1>
<form method="post" action="<?=$_SERVER['PHP_SELF'];?>">

    Имя: <input type="text" name="fname"><br>
    Фамилия: <input type="text" name="lname"><br>
    <input type="submit" value="Отправить!">

</form>

