<?php
    //Подключаем основные классы
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/Core.class.php');

    //Класс текущего модуля
    require_once('Sections.class.php');

    //Запуск модуля
    $core = new Sections();
?>