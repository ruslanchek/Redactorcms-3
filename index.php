<?
//Подключаем основные классы
require_once($_SERVER['DOCUMENT_ROOT'] . '/view/Core.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/view/Base.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/view/BlocksModulesLogic.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/view/Project.class.php');

//Запуск модуля
$core = new Project();