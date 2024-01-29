<?php 

    $connect = mysqli_connect(
        'localhost', 
        'root',
        'root',
        'news'
    );

    if ($connect == false){
        echo "Ошибка подключения к БД";
    }
?>
