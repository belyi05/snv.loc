<?php
/**
 * newspaper created
 *
 * by Lastbyte 
 * last modified 03/05/2012 - 18:00
 */

/**
 * каталог с файлами для формирования газеты
 */
define('NEWSPAPER_PATH_UPLOAD', 'upload'); 
/**
 * катлог газеты
 */
define('NEWSPAPER_PATH_PAGES', 'pages');
/**
 * каталог с арзихвом газеты в разных форматах
 */
define('NEWSPAPER_PATH_DOWNLOAD', 'download');
/**
 * название страниц газеты
 */
define('NEWSPAPER_PAGE_NAME', 'page');
/**
 * типы вставки
 */
define('NEWSPAPER_HTML_INSERT_TYPE_TOP', 1);
define('NEWSPAPER_HTML_INSERT_TYPE_BOTTOM', 2);
/**
 * типы действия с email
 */
define('NEWSPAPER_SUBSCRIBE', 0);
define('NEWSPAPER_UNSUBSCRIBE', 1);
/**
 * типы подписки
 */
define('NEWSPAPER_EMAIL_VIEW', 0);
define('NEWSPAPER_EMAIL_SUBSCRIBE', 1);
define('NEWSPAPER_EMAIL_UNSUBSCRIBE', 2);

/**
 * getInfo
 */
function _newspaper_getInfo($var, $default = FALSE) {
  // загружаем конфиг
  include(NEWSPAPER_FILE_CONFIG);
  // вывод значения или дефолта
  return isset($INFO[$var])? $INFO[$var]: $default;
}

/**
 * setInfo
 */
function _newspaper_setInfo($var, $value) {
  // загружаем конфиг
  include(NEWSPAPER_FILE_CONFIG);
  // меняем значение
  $INFO[$var] = $value;
  
  $data = "<?php \r";
  foreach ($INFO as $key => $val) {
    $data .= "\$INFO['{$key}'] = '{$val}';\r";
  }
  // птаемся записать конфиг
  $status = file_put_contents(NEWSPAPER_FILE_CONFIG, $data);

  //ошибка записи 
  if (!$status) {
  }
}

/**
 * _newspaper_subscribe
 */
function _newspaper_subscribe($email, $type, $data = array()) {
  // загружаем подписчиков
  include(NEWSPAPER_FILE_MEMBERS);
  // empty file
  if (!isset($members)) {
    $members = array();
  }
  
  $rebuild = FALSE;
  $result = FALSE;
  switch ($type) {
    // отписать
    case NEWSPAPER_EMAIL_UNSUBSCRIBE:
      if (isset($members[$email])) {
        unset($members[$email]);
        $rebuild = TRUE;
      }    
      break;
    // подписать
    case NEWSPAPER_EMAIL_SUBSCRIBE:
      if (!isset($members[$email])) {
        $members[$email] = $data;
        $rebuild = TRUE;
      }       
      break;
    // вывод email
    case NEWSPAPER_EMAIL_VIEW:
    default:
      if (isset($members[$email])) {
        $result = $members[$email];
      }
  }
  
  // rebuild
  if ($rebuild) {
    $data = "<?php \r";
    foreach ($members as $key => $val) {
      if (is_array($val)) {
        $data .= "\$members['{$key}'] = array(\r";
        foreach ($val as $k => $v) {
          $data .= "  '{$k}' => '{$v}',\r";
        }
        $data .= ");\r";
      }
      else {
        $data .= "\$members['{$key}'] = '{$val}';\r";
      }
    }
    // птаемся записать конфиг
    $status = file_put_contents(NEWSPAPER_FILE_MEMBERS, $data);  

    //ошибка записи 
    if (!$status) {
      
    }
    else {
      $result = TRUE;
    }
  }
  
  return $result;
}

/**
 *_newspaper_getMembers
 *
 * возвращает список пописчиков
 */
function _newspaper_getMembers($page, $limit) {
  // загружаем подписчиков
  include(NEWSPAPER_FILE_MEMBERS);
  $data = array();
  // not empty file
  if (isset($members)) {
    foreach ($members as $email => $member) {
      $data[] = array(
        'name' => $member['name'],
        'surname' => $member['surname'],
        'phone' => $member['phone'],
        'email' => $email,
      );
    }
  }
  krsort($data);
  
  return array(
    'title' => 'Список подписчиков газеты',
    'headers' => array('имя', 'фамиля', 'телефон', 'email'),
    'data' => $data,
    'end' => count($data),
  );
}

/**
 * _newspaper_getRegMembers
 *
 * возвращает список зарегитсрированых пользователей
 */
function _newspaper_getRegMembers($page, $limit) {
  $start = $page * $limit;
  // список пользователей 
  $query = db_query("SELECT name,famil,phone,email,date FROM users ORDER BY id_user DESC LIMIT {$start}, {$limit}");
  $members = db_fetch_array($query);
  // максимальное количество пользователей
  $query = db_query('SELECT COUNT(*) FROM users');
  $end = db_fetch_column($query);
  
  return array(
    'title' => 'Список зарегистрирвоаных пользователей',
    'headers' => array('имя', 'фамиля', 'телефон', 'email', 'дата регистрации'),
    'data' => $members,
    'end' => $end,
  );
} 

/**
 * _newspaper_getAbsolutePath
 *
 * абсолютный путь к файлу
 */
function _newspaper_getAbsolutePath($path) {
  // кодируем руские символы
  $path = iconv("cp1251", "UTF-8//IGNORE", $path);
  // возвращаем путь
  $path = preg_replace('/%2F/', '/', $path);

  $filename = 'http://' . $_SERVER['HTTP_HOST'] . '/' . _newspaper_getInfo('root_path') . '/' . $path;
  return $filename;
}
 
/**
 * getPageExt
 *
 * Доступные расширения для тела газеты
 */
function _newspaper_getPageExt() {
  return array('html');
}

/**
 * pageUrl
 *
 * Возвращает url страницы
 */
function _newspaper_pageUrl($id, $ext, $absolute = FALSE) {
  $url = NEWSPAPER_PAGE_NAME . '_' . $id . '.' . $ext;

  // абсолютный путь
  if ($absolute) {
    $url = _newspaper_getAbsolutePath(_newspaper_getNumberPath($url));
  }
  
  return $url;
}

/**
 * getNumberPath
 *
 * Путь к выпуску газеты
 */
function _newspaper_getNumberPath($filename = '', $id = NULL, $create = TRUE) {
  // если ид выпуска не указан берем последний
  if (!isset($id)) {
    $id = _newspaper_getInfo('number');
  }
  // директория выпуска
  $dir = NEWSPAPER_PATH_PAGES . '/' . _newspaper_getInfo('dir') . '_' . $id;
  
  // создаем директорию выпуска
  if (!file_exists($dir) && $create) {
    $status = mkdir($dir);
    
    // ошибка осздания каталога
    if (!$status) {
    }
  }
  
  return !empty($filename)? $dir . '/' . $filename: $dir; 
}

/**
 * insertString
 *
 * вставка в строку
 */
function _newspaper_insertString($pattern, $s, $data) {
  $newdata = preg_replace($pattern, $s, $data);
  
  return $newdata;
}

/**
 * saveFiles
 *
 * сохранение файлов газеты
 */
function _newspaper_saveFiles($files) {
  // пытаемся записать файл
  foreach ($files as $filename => $data) {
    $status = file_put_contents(_newspaper_getNumberPath($filename, NULL, TRUE), $data);
    
    // неудалось создать файл
    if (!$status) {
    }
  }
}

/**
 * moveFiles
 *
 * перемещение файлов газеты
 */
function _newspaper_moveFiles($files) {
  foreach ($files as $filename => $file) {
    // пытаемся переместить файл
    $status = rename($file, _newspaper_getNumberPath($filename, NULL, TRUE));
    
    // ошибка
    if (!$status) {
    }
  }
}

/**
 * deleteFiles
 *
 * удаляем файлы
 */
function _newspaper_deleteFiles($files) {
  foreach ($files as $file) {
    // удалем файл
    $status = unlink($file);
    
    // файл не удален
    if (!$status) {
    }
  }
}

/**
 * getTemplate
 *
 * вывести данные из шаблона
 */
function _newspaper_getTemplate($template, $args = array()) {
  // создание переменых
  foreach ($args as $key => $var) {
    ${$key} = $var;
  }

  ob_start();
  include(NEWSPAPER_ROOT . '/' . $template . '.tpl.php');
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
} 

/**
 * insertInHtml
 *
 * вставка в html
 */
function _newspaper_insertInHtml($s, &$data, $scope = 'body', $type = NEWSPAPER_HTML_INSERT_TYPE_TOP) {
  $pattern = '';
  
  // тип вставки
  switch ($type) {
    // вставка в после открытия тега
    case NEWSPAPER_HTML_INSERT_TYPE_TOP:
      $pattern = '\<' . $scope . '\>';
      $s = '<' . $scope . ">\r" . $s;
      break;
      
    // вставка пред закрытием тега
    case NEWSPAPER_HTML_INSERT_TYPE_BOTTOM:
      $pattern = '\<\/' . $scope . '\>';
      $s = $s . "\r</" . $scope . '>';
      break;
  }
  
  // вставка в файл
  $data = _newspaper_insertString('/' . $pattern . '/', $s, $data);
}

/**
 * movePages
 *
 * Перемещает файлы страниц
 */
function _newspaper_movePages($files, $archive) {
  // формируем ссылки на архивы в разных форматах
  $download = array();
  foreach ($archive as $ext => $file) {
    $download[$ext] = _newspaper_getAbsolutePath(_newspaper_getNumberPath($file));
  }

  // переименовываем файлы
  $rename = array();
  foreach ($files as $filename => $file) {
    $id = count($rename) + 1; // id страницы
    $info = pathinfo($filename); //получаем инфу о файле
    $data = file_get_contents($file); // содержимое сраницы
    
    // вставляем в страницу css
    $css = '<link type="text/css" rel="stylesheet" href="' . _newspaper_getAbsolutePath('style.css') . '" media="all">';
    _newspaper_insertInHtml($css, $data, 'head', NEWSPAPER_HTML_INSERT_TYPE_BOTTOM);
    
    // вставляем панель управления в страницу
    $navigate = _newspaper_getTemplate('navigate', array(
      'id' => _newspaper_getInfo('number'),
      'prev' => ($id <= 1)? FALSE: _newspaper_pageUrl($id-1, $info['extension'], TRUE),
      'next' => ($id >= count($files))? FALSE: _newspaper_pageUrl($id+1, $info['extension'], TRUE),
      'number_url' => array(
        'first' => _newspaper_getAbsolutePath('index.php?id=move&target=first'),
        'prev' => _newspaper_getAbsolutePath('index.php?id=move&target=prev&n=' . _newspaper_getInfo('number')),
        'next' => _newspaper_getAbsolutePath('index.php?id=move&target=next&n=' . _newspaper_getInfo('number')),
        'last' => _newspaper_getAbsolutePath('index.php?id=move&target=last'),
      ),
      'download' => $download,
      'home_url' => _newspaper_getInfo('home_url'),
      'subscribe_url' => _newspaper_getAbsolutePath('index.php?id=subscribe'),
    ));
    _newspaper_insertInHtml($navigate, $data, 'body', NEWSPAPER_HTML_INSERT_TYPE_BOTTOM);
    // запихиваем дату в массив
    $rename[_newspaper_pageUrl($id, $info['extension'])] = $data;
  }
  
  _newspaper_saveFiles($rename);
  _newspaper_deleteFiles($files);
}

/**
 * mergeFiles
 *
 * Соединяет файлы в одни
 * и удаляет файлы сбора
 */
function _newspaper_mergeFiles($filename, $files) {
  $data = '';
  // получаем контент файлов
  foreach ($files as $file) {
    if ($content = file_get_contents($file)) {
      $data .= $content;
    }
  }
  
  // запись в файл
  _newspaper_saveFiles(array($filename => $data));
  // удаление файлов
  _newspaper_deleteFiles($files);
}
 
/**
 * checkDir
 *
 * проверка каталогов
 */ 
function newspaper_checkDir($dir) {
  $errors = array();
  // проверка на существование
  if (!file_exists($dir)) {
    newspaper_viewError("каталог {$dir} не существует!");
  }
  // проверка прав
  elseif (!is_writable($dir) || !is_readable($dir)) {
    newspaper_viewError("Установите каталогу {$dir} chmod 777");
  }
} 
 
 
/**
 * findFiles
 *
 * Ищет в директории скрипта папку upload,
 * и проверяет наличие фалов для создания выпуска газеты
 */
function newspaper_findFiles() {
  $files = array(
    'pages' => array(), // список страниц газеты
    'styles' => array(), // список стилей газеты
    'move' => array(), // список переносимых файлов
    'download' => array(), // список архивов газеты, в разных форматах
  );
    
  // проходимся по директории, и собираем все файлы.
  $dirs = array(NEWSPAPER_PATH_UPLOAD);
  while (!empty($dirs)) {
    $dir = array_shift($dirs);
    $scan = array_slice(scandir($dir), 2); // убираем ссылки на выход из каталога
      
    // спиоск файлов и каталогов 
    foreach ($scan as $filename) {    
      // если нашли каталог
      $path = $dir . '/' . $filename;
      if (is_dir($path)) {
        // записываем его путь
        $dirs[] = $path; 
        
        // список каталогов в корне
        if ($dir == NEWSPAPER_PATH_UPLOAD) {
          $files['move'][$filename] = $dir . '/' . $filename;
        }
      }
      // парсим файлы
      else {
        $info = pathinfo($filename);
          
        if (isset($info['filename']) && isset($info['extension'])) {
          // формируем список html-файлов
          if (in_array($info['extension'], _newspaper_getPageExt()) && $dir == NEWSPAPER_PATH_UPLOAD) {
            $files['pages'][$info['basename']] = $dir . '/' . $info['basename'];
          }
          // формируем список стилей
          elseif ($info['extension'] == 'css' && $dir == NEWSPAPER_PATH_UPLOAD) {
            $files['styles'][$info['basename']] = $dir . '/' . $info['basename'];
          }
          // формируем список архива газеты в разных форматах
          elseif ($dir == NEWSPAPER_PATH_UPLOAD . '/' . NEWSPAPER_PATH_DOWNLOAD) {
            $files['download'][$info['extension']] = NEWSPAPER_PATH_DOWNLOAD . '/' . $info['basename'];
          }
          // список файлов в корне
          elseif ($dir == NEWSPAPER_PATH_UPLOAD) {
            $files['move'][$info['basename']] = $dir . '/' . $info['basename'];
          }
        }
      }
    }
  }
  natcasesort($files['pages']);
   
  return $files;
}

/**
 * newspaper_home
 *
 * переход домой
 */
function newspaper_home() {
  header ('Location: ' . _newspaper_getInfo('home_url'));
}

/**
 * newspaper_create
 *
 * формирует новый номер газеты
 */
function newspaper_create() {
  // проверки на катлоги
  newspaper_checkDir(NEWSPAPER_PATH_UPLOAD);
  newspaper_checkDir(NEWSPAPER_PATH_PAGES);
  // список файлов загруженых для формирования газеты
  $files = newspaper_findFiles();
  // формируем газету
  if (!empty($files['pages'])) {
    // повышаем счетчик
    $number = _newspaper_getInfo('number');
    _newspaper_setInfo('number', $number+1);
  
    //_newspaper_mergeFiles('style.css', $files['styles']); // создаем единый css
    _newspaper_movePages($files['pages'], $files['download']); // перенос страниц газеты
    _newspaper_moveFiles($files['styles']); // перенос css
    _newspaper_moveFiles($files['move']); // перенос каталогов
  }
  
  print '<a href="' . _newspaper_getAbsolutePath('index.php') . '">Вернуться к газете</a>';
}


/**
 * newspaper_move
 *
 * выводить последний номер газеты
 *
 * исторический сложилось что этой функции есть место быть,
 * из-за переделки архитекутуры
 */
function newspaper_move() {
  $target = isset($_GET['target'])? $_GET['target']: FALSE;
  $n = isset($_GET['n'])? $_GET['n']: 0;

  newspaper_view($target, $n);
} 

/**
 * newspaper_view
 *
 * выводить последний номер газеты
 */ 
function newspaper_view($target = FALSE, $n = 0) {
  // сканим директорию номеров
  // убираем ссылки на выход из каталога
  $pages = array_slice(scandir(NEWSPAPER_PATH_PAGES), 2);
  if (empty($pages)) {
    newspaper_viewError('газета еще не создана.');
  }
  
  // делаем натуральную сортировку
  natcasesort($pages);
  // создаем список номеров
  $numbers = array();
  foreach ($pages as $page) {
    $numbers[] = (int)preg_replace('/' . _newspaper_getInfo('dir') . '_/', '', $page);
  }
  
  $first = $numbers[0];
  $last = $numbers[count($numbers)-1];

  switch ($target) {
    // первый номер газеты
    case 'first':
      $id = $first;
      break;
    // предыдущий
    case 'prev':
      $pid = $n;
      while (empty($id) && $pid > 0) {
        $pid--;
        if ($key = array_search($pid, $numbers)) {
          $id = $numbers[$key];
        }
      }
      
      // ненайден предедущий номер выбрать первый
      if ($pid <= 0) {
        $id = $first;
      }
      break;
    // следующий
    case 'next':
      $pid = $n;
      while (empty($id) && $pid < $last) {
        $pid++;
        if ($key = array_search($pid, $numbers)) {
          $id = $numbers[$key];
        }
      }
      // ненайден предедущий номер выбрать первый
      if ($pid >= $last) {
        $id = $last;
      }    
      break;
    // последний
    case 'last':
    default:
      $id = $last;
      break;
  }

  // имя директории последнего номер газеты
  $filename = _newspaper_getAbsolutePath(_newspaper_getNumberPath(NEWSPAPER_PAGE_NAME . '_1.html', $id));
  // редирект на первую страницу
  header ("Location: {$filename}");
}

/**
 * newspaper_subscribe
 *
 * вывод страницы для подписки или отказа от неё
 */
function newspaper_subscribe() {
  $type = (isset($_GET['type']) && $_GET['type'] == NEWSPAPER_UNSUBSCRIBE)? NEWSPAPER_UNSUBSCRIBE: NEWSPAPER_SUBSCRIBE;
  $url = 'index.php?id=subscribe';
  $change_url = 'Если вы хотите @type, перейдите на <a href="@url">эту страницу.</a> <br />';
  //$_POST
  $args = array(
    'subscribe-name' => '',
    'subscribe-surname' => '',
    'subscribe-phone' => '',
    'subscribe-email' => '',
  );
  if (!empty($_POST)) {
    $args = $_POST + $args;
  }
  
  $info = array();
  // ищем email
  if (isset($args['subscribe-email'])) {
    // проверка на email
    $pattern = "/^[-a-z0-9!#$%&'*+\/=?^_`{|}~]+(?:\.[-a-z0-9!#$%&'*+\/=?^_`{|}~]+)*@(?:[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(?:aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/";
    $matches = preg_match($pattern, $args['subscribe-email']);
    // все норм записываем email
    if (!empty($matches)) {
      $email = $args['subscribe-email'];
    }
    // ошибка
    else {
      $info[] = "Неправильный email {$args['subscribe-email']}";
    }
  }
  
  // проверка
  if (isset($args['subscribe-submit']) && $type == NEWSPAPER_SUBSCRIBE) {
    if (empty($args['subscribe-name'])) {
      $info[] = 'Необходимо заполнить поле Имя';
      $email = FALSE;
    }
    if (empty($args['subscribe-surname'])) {
      $info[] = 'Необходимо заполнить поле Фамилия';
      $email = FALSE;
    }
    if (empty($args['subscribe-phone'])) {
      $info[] = 'Необходимо заполнить поле Телефон';
      $email = FALSE;
    }
  }
  
  // проверяем тип вызова
  // отписаться
  if ($type == NEWSPAPER_UNSUBSCRIBE) {
    $title = 'Отписаться';
    $change_url = preg_replace(array('/@type/', '/@url/'), array('"подписаться на газету"', $url . '&type=' . NEWSPAPER_SUBSCRIBE), $change_url);
  
    if ($email) {
      // пользователя не существует
      if (!_newspaper_subscribe($email, NEWSPAPER_EMAIL_VIEW)) {
        $info[] = "Email {$email} не состоит подписчиках";
      }
      // пользователь существует
      else {
        // убираем email из списка подписчиков
        _newspaper_subscribe($email, NEWSPAPER_EMAIL_UNSUBSCRIBE);
        // выводим сообщение об успешной отписке
        $info[] = "Email {$email} убран из списка подписчиков";
      }
    }
  }
  // подписаться
  else {
    $title = 'Подписаться';
    $change_url = preg_replace(array('/@type/', '/@url/'), array('"отказаться от подписки"', $url . '&type=' . NEWSPAPER_UNSUBSCRIBE), $change_url);
  
    if ($email) {
      // пользователь существует     
      if (_newspaper_subscribe($email, NEWSPAPER_EMAIL_VIEW)) {
        $info[] = "Email {$email} уже состоит подписчиках";
      }
      // пользователя не существует
      else {    
        // добавляем email в список подписчиков
        _newspaper_subscribe($email, NEWSPAPER_EMAIL_SUBSCRIBE, array(
          'name' => $args['subscribe-name'],
          'surname' => $args['subscribe-surname'],
          'phone' => $args['subscribe-phone'],
        ));
        
        // выводим сообщение об успешной подписке
        $info[] = "Email {$email} добавлен в список подписчиков";
      }
    }    
  }
  
  print _newspaper_getTemplate('subscribe', array(
    'title' => $title,
    'type' => $type,
    'info' => $info,
    'change_url' => $change_url,
    'home_title' => _newspaper_getInfo('home_title'),
    'url' => $url . '&type=' . ($type),
    'args' => $args,
  ));
}


/**
 * newspaper_admin
 */
function newspaper_admin($table = FALSE) {
  print _newspaper_getTemplate('admin', array(
    'title' => 'Админка газеты',
    'home_url' => _newspaper_getInfo('home_url'),
    'newspaper_url' => _newspaper_getAbsolutePath('index.php'),
    'create_url' => _newspaper_getAbsolutePath('index.php?id=create'),
    'members_url' => _newspaper_getAbsolutePath('admin/index.php?id=statistic&func=_newspaper_getMembers'),
    'reg_members_url' => _newspaper_getAbsolutePath('admin/index.php?id=statistic&func=_newspaper_getRegMembers'),
    'table' => $table,
  ));
}

/**
 * newspaper_table
 *
 * вывод списка
 */
function newspaper_table($data) {
  $variables = $data + array(
    'title' => '',
    'headers' => array(),
    'data' => array(),
  );
  
  //проверка на предедущую страницу
  if ($data['page'] > 0) {
    $variables['prev_url'] = _newspaper_getAbsolutePath('admin/index.php?id=statistic&func=' . $data['func'] . '&page=' . ($data['page']-1) . '&offset=' . $data['offset']);
  }
  // проверка на следующу страницу
  if (($data['page'] * $data['limit'] + count($data['data'])) < $data['end']) {
    $variables['next_url'] = _newspaper_getAbsolutePath('admin/index.php?id=statistic&func=' . $data['func'] . '&page=' . ($data['page']+1) . '&offset=' . $data['offset']);  
  }
  
  print _newspaper_getTemplate('table', $variables);
}

/**
 * newspaper_statistic
 *
 * вывод статистики
 */
function newspaper_statistic() {
  $func = isset($_GET['func'])? $_GET['func']: '';
  $page = isset($_GET['page'])? $_GET['page']: 0;
  $limit = isset($_GET['limit'])? $_GET['limit']: 30;

  if (function_exists($func)) {
    $data = $func($page, $limit);
    
    $data += array(
      'page' => $page,
      'limit' => $limit,
      'func' => $func,
    );
    newspaper_admin($data);
  }
  else {
    newspaper_viewError('statistic function not exists');
  }
}