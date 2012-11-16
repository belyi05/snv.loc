<?php
/**
 * newspaper cp
 *
 * by Lastbyte
 * last modified 22/06/2012
 */
/**
 * корневая директория
 */ 
define('NEWSPAPER_ROOT', '..'); 
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

include_once(NEWSPAPER_PATH_INCLUDES . '/boot.inc');

// 
$id = !empty($_GET['id'])? $_GET['id']: 'admin';
$func = 'newspaper_' . $id;

if (function_exists($func)) {
  $func();
}