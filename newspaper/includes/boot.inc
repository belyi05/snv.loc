<?php
  // ������� ��� ������ � mysql
  include_once(NEWSPAPER_PATH_INCLUDES . '/mysql.inc');
  // ������� ��� ������ � �������
  include_once(NEWSPAPER_PATH_INCLUDES . '/newspeper.inc');

  /**
   * viewError
   *
   * ����� ������
   */
  function newspaper_viewError($error) {
    print $error . "\r";
    // ������ ������
    exit();
  }