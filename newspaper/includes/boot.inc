<?php
  // функции для работы с mysql
  include_once(NEWSPAPER_PATH_INCLUDES . '/mysql.inc');
  // функции для работы с газетой
  include_once(NEWSPAPER_PATH_INCLUDES . '/newspeper.inc');

  /**
   * viewError
   *
   * вывод ошибок
   */
  function newspaper_viewError($error) {
    print $error . "\r";
    // глушим скрипт
    exit();
  }