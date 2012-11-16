<?php
  function _db_get_connect_options($name) {
    $default_connect = array(
      'default' => array(
        'server' => 'mysql.Invest10.z8.ru',
        'name' => 'dbu_invest10_2',
        'pass' => 'w2GRrcgpfRy',
        'db' => 'db_invest10_2',
      ),
    );
    
    
    if (isset($default_connect[$name])) {
      $result = $default_connect[$name];
    }
    else {
      newspaper_viewError('connect options not exists');
      $result = FALSE;
    }
    
    return $result;
  }

  /**
   * db_connect
   *
   * подключение
   */
  function db_connect($server, $name, $pass, $db) {
    
    $ln_db = mysql_connect($server, $name, $pass);
    if (!$ln_db) {
      newspaper_viewError('No connect');
    }
    if(!mysql_select_db($db, $ln_db)){
      newspaper_viewError('No DB');
    }
    else{
      mysql_query("SET NAMES utf8");	
    }
    
    return $ln_db;
  }
  
  /**
   * db_query
   *
   * запрос
   */
  function db_query($query, $connect_name = 'default') {
    $options = _db_get_connect_options($connect_name);
    $connect = db_connect($options['server'], $options['name'], $options['pass'], $options['db']);
    if ($connect) {
      return mysql_query($query, $connect);
    }
    
    return FALSE;
  }
  
  /**
   * db_fetch_array
   *
   * массив
   */
  function db_fetch_array($result) {
    $data = array();
    
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $data[] = $row;
    }
    
    return $data;
  }
  
  /**
   * db_fetch_col
   */
  function db_fetch_column($result, $index = 0) {
    $row = mysql_fetch_array($result, MYSQL_NUM);
    
    $result = FALSE;
    if (isset($row[$index])) {
      $result = $row[$index];
    }
   
    return $result;
  }