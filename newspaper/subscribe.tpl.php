<!DOCTYPE html>
<html>
<head>
  <link type="text/css" rel="stylesheet" href="style.css" media="all" />
</head>
<body>
  <div id="body-wrapper" align="center">
    <div id="subscribe-wrapper">
      <!-- head -->
      <div id="subscribe-head"></div>
      <!-- content -->
      <div id="subscribe-content" align="left">
        <!-- return home -->
        <p><a href="index.php?id=home"><?php print $home_title;?></a></p>
        <!-- title -->
        <div id="subscribe-title"><h1><?php print $title;?></h1></div>
        <!-- info -->
        <?php if ($info):?>
          <?php foreach ($info as $message):?>
          <div class="subscribe-info"><li><p><?php print $message;?></p></div>
          <?php endforeach;?>
        <?php endif;?>
        <!-- subscribe form -->
        <div id="subscribe-form-wrapper">
          <form id="subscribe-form" name="form-subscribe" action="<?php print $url;?>" method="POST">
            <?php if ($type == NEWSPAPER_SUBSCRIBE):?>
              <div class="form-element clearfix"><div class="wrapper-form-element">Имя*:</div><input name="subscribe-name" value="<?php print $args['subscribe-name'];?>" type="text" /></div>
              <div class="form-element clearfix"><div class="wrapper-form-element">Фамилия*:</div><input name="subscribe-surname" value="<?php print $args['subscribe-surname'];?>" type="text" /></div>
              <div class="form-element clearfix"><div class="wrapper-form-element">Телефон*:</div><input name="subscribe-phone" value="<?php print $args['subscribe-phone'];?>" type="text" /><div class="wrapper-form-element">пример: 89110010101</div></div>
              <div class="form-element clearfix"><div class="wrapper-form-element">E-mail*:</div><input name="subscribe-email" value="<?php print $args['subscribe-email'];?>" type="text" /></div>
            <?php else:?>
              <div class="form-element clearfix"><div class="wrapper-form-element">E-mail*:</div><input name="subscribe-email" value="<?php print $args['subscribe-email'];?>" type="text" /></div>
            <?php endif;?>
              <div class="form-element clearfix">* поля, обязательные для заполнения.</div>
              <div class="form-element-subscribe clearfix"><input name="subscribe-submit" type="submit" value="<?php print $title;?>" /></div>            
          </form>
        </div>
        <!-- return newspaper -->
        <p><a href="index.php?id=view">Вернуться к газете</a></p>
        <!-- change_url -->
        <p><?php print $change_url;?></p> 
      </div>
     
      <!-- bottom -->
      <div id="subscribe-footer"></div>
    </div>
  </div>
</body>
</html>