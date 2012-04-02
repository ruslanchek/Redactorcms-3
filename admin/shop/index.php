<?php
    //Подключаем основные классы
    require_once($_SERVER['DOCUMENT_ROOT'].'/smarty/Smarty.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/shared/utilities.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/shared/config.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/shared/database.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/core.class.php');

    //Класс текущего модуля
    require_once('shop.class.php');

    //Запуск модуля
    $core = new Shop();
?>