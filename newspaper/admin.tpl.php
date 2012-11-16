<!DOCTYPE html>
<html>
<head>
  <link type="text/css" rel="stylesheet" href="style.css" media="all" />
</head>
<body>
  <h3><?php print $title;?></h3>
  <p>
    <a href="<?php print $create_url;?>">Добавить номер.</a><br/>
    Для создания нового номера газеты, необходимо залить файлы в папку nespaper/upload после чего нажать на ссылку "добавить номер".<br/>
    (html-файлы автоматически переименовываються в pageN.html, css-файлы переносяться как етсь, все что находиться в папке 
    download - воспринимаеться как файлы для закачки(для всех фавлов будут созданы ссыки для скачивания)  
  </p>
  <p><a href="<?php print $home_url;?>">На главную</a> <a href="<?php print $newspaper_url;?>">Вернуться к газете</a></p>  
  <p><a href="<?php print $members_url;?>">Список подписчиков газеты</a> <a href="<?php print $reg_members_url;?>">Список пользователей</a></p>
 
  <?php if (!empty($table)):?>
    <?php print newspaper_table($table);?>
  <?php endif;?>
</body>
</html>