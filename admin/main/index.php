<?php
    //Подключаем основные классы
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core.class.php');

    //Класс текущего модуля
    require_once('Main.class.php');

    //Запуск модуля
    $core = new Main();
?>