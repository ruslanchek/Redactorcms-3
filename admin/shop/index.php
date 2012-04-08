<?php
    //Подключаем основные классы
    require_once($_SERVER['DOCUMENT_ROOT'].'/api/core.class.php');

    //Класс текущего модуля
    require_once('Shop.class.php');

    //Запуск модуля
    $core = new Shop();
?>