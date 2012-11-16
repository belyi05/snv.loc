<?php
/**
 * newspaper index
 *
 * by Lastbyte 
 * last modified 03/05/2012 - 18:00
 */

/**
 * корневая директория
 */
define('NEWSPAPER_ROOT', getcwd());
/**
 * каталог скриптов
 */
define('NEWSPAPER_PATH_INCLUDES', NEWSPAPER_ROOT . '/includes');
/**
 * файл конфига
 */
define('NEWSPAPER_FILE_CONFIG', NEWSPAPER_PATH_INCLUDES . '/config.inc');
/**
 * подписчики
 */
define('NEWSPAPER_FILE_MEMBERS', NEWSPAPER_PATH_INCLUDES . '/members.inc');

// основной файл иклуда
include_once(NEWSPAPER_PATH_INCLUDES . '/boot.inc');

// 
$id = !empty($_GET['id'])? $_GET['id']: 'view';
$func = 'newspaper_' . $id;

if (function_exists($func)) {
  $func();
}