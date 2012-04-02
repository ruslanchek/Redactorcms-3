<?php
    //Подключаем основные классы
    require_once($_SERVER['DOCUMENT_ROOT'].'/api/core.class.php');

    //Класс текущего модуля
    require_once('structure.class.php');

    //Запуск модуля
    $core = new Structure();
?>