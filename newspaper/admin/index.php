<?php
/**
 * newspaper cp
 *
 * by Lastbyte
 * last modified 22/06/2012
 */
/**
 * �������� ����������
 */ 
define('NEWSPAPER_ROOT', '..'); 
/**
 * ������� ��������
 */
define('NEWSPAPER_PATH_INCLUDES', NEWSPAPER_ROOT . '/includes');
/**
 * ���� �������
 */
define('NEWSPAPER_FILE_CONFIG', NEWSPAPER_PATH_INCLUDES . '/config.inc');
/**
 * ����������
 */
define('NEWSPAPER_FILE_MEMBERS', NEWSPAPER_PATH_INCLUDES . '/members.inc');

include_once(NEWSPAPER_PATH_INCLUDES . '/boot.inc');

// 
$id = !empty($_GET['id'])? $_GET['id']: 'admin';
$func = 'newspaper_' . $id;

if (function_exists($func)) {
  $func();
}